<?php 

require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

use App\Controllers\ProductController;
use App\Controllers\FormController;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => [ProductController::class, 'index'],
    '/products' => [ProductController::class, 'index'],
    '/form' => [FormController::class, 'index'],
];

if (!isset($routes[$path])) {
    http_response_code(404);
    echo 'Page not found';
    exit;
}

[$controllerClass, $method] = $routes[$path];

$controller = new $controllerClass();
$controller->$method();