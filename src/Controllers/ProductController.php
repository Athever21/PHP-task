<?php

namespace App\Controllers;

use App\Services\ApiService;
use App\Queries\ProductQuery;

class ProductController {
    public function index(): void {
        $title = 'Products';
        $service = new ApiService();

        $page = (int) ($_GET['page'] ?? 1);
        $page = $page > 0 ? $page : 1;

        $query = ProductQuery::make()
            ->category($_GET['category'] ?? null)
            ->search($_GET['search'] ?? null)
            ->page($page)
            ->limit(12);

        $result = $service->getProducts($query);

        $products = $result['products'] ?? [];
        $categories = $service->getCategories();
        $totalPages = (int) ceil(($result['total'] ?? 0) / $query->getLimit());

        $scripts = [
            
        ];

        $styles = [
            '/assets/css/products.css',
            '/assets/css/products-responsive.css'
        ];

        $view = __DIR__ . '/../../views/products.php';
        include __DIR__ . '/../../views/layout.php';
    }
}