<?php

namespace App\Services;

use App\Queries\ProductQuery;

class ApiService {
    private string $baseUrl = 'https://dummyjson.com/products';

    public function getCategories(): array {
        $cacheFile = __DIR__ . '/../../storage/categories.cache.json';

        if (
            file_exists($cacheFile) &&
            filemtime($cacheFile) > time() - 3600
        ) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        $response = file_get_contents($this->baseUrl . '/categories');
        $categories = json_decode($response, true);

        if (!is_dir(dirname($cacheFile))) {
            mkdir(dirname($cacheFile), 0777, true);
        }

        file_put_contents($cacheFile, json_encode($categories));

        return $categories;
    }

    public function getProducts(ProductQuery $query): array {
        // If no filters, use the standard query
        if ($query->getCategory() === null && $query->getSearch() === null) {
            $request = $query->toRequest($this->baseUrl);
            $url = $request['url'] . '?' . http_build_query($request['params']);
            $response = file_get_contents($url);

            if ($response === false) {
                return [
                    'products' => [],
                    'total' => 0,
                    'limit' => $query->getLimit(),
                ];
            }

            $data = json_decode($response, true);
            return [
                'products' => $data['products'] ?? [],
                'total' => $data['total'] ?? 0,
                'limit' => $query->getLimit(),
            ];
        }

        // For filtered queries, fetch all products and filter in PHP
        $allProducts = $this->getAllProducts();

        // Filter by category if set
        if ($query->getCategory() !== null) {
            $allProducts = array_filter($allProducts, function($product) use ($query) {
                return $product['category'] === $query->getCategory();
            });
        }

        // Filter by search if set
        if ($query->getSearch() !== null) {
            $searchTerm = strtolower($query->getSearch());
            $allProducts = array_filter($allProducts, function($product) use ($searchTerm) {
                return str_contains(strtolower($product['title']), $searchTerm) ||
                       str_contains(strtolower($product['description']), $searchTerm);
            });
        }

        // Apply pagination
        $total = count($allProducts);
        $offset = ($query->getPageNumber() - 1) * $query->getLimit();
        $products = array_slice($allProducts, $offset, $query->getLimit());

        return [
            'products' => array_values($products), // Reindex array
            'total' => $total,
            'limit' => $query->getLimit(),
        ];
    }

    private function getAllProducts(): array {
        $url = $this->baseUrl . '?limit=0'; // Fetch all
        $response = file_get_contents($url);

        if ($response === false) {
            return [];
        }

        $data = json_decode($response, true);
        return $data['products'] ?? [];
    }
}