<?php

namespace App\Services;

class ApiService {
    private string $baseUrl = "";
    private string $apiKey = "";

    public function __construct() {
        $this->baseUrl = $_ENV['API_URL'];
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getCatrgories(): array {
        return $this->request('categories');
    }

    public function getProducts(?int $categoryId = null): array {
        $params = [];

        if ($categoryId) {
            $params['idKat'] = $categoryId; 
        }

        return $this->request('products', $params);
    }

    private function request(string $action, array $params = []) {
        return [];
        $query = array_merge([
            "auth" => $this->apiKey,
            "action" => $action
        ], $params);

        $url = $this->baseUrl . '?' . http_build_query($query);
        $response = file_get_contents($url);
    
        if ($response === false) {
            throw new \Exception("API request failed");
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Failed to decode API response: " . json_last_error_msg());
        }

        return $data;
    }
}