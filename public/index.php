<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Services\ApiService;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
    case '/products':
        $service = new ApiService();
        $products = $service->getProducts();

        $title = "Products";
        $view = __DIR__ . '/../views/products.php';
        break;
    case '/form':
        $title = 'Form';
        $view = __DIR__ . '/../views/form.php';
        break;
    default:
        http_response_code(404);
        echo "Page not found";
        exit;
}

include __DIR__. '/../views/layout.php';