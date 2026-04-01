<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Services\ApiService;
use App\Services\CaptchaService;

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

        $styles = [
            '/assets/css/form.css',
            '/assets/css/form-responsive.css'
        ];

        $scripts = [
            'https://www.google.com/recaptcha/api.js',
            '/assets/js/form.js'
        ];

        break;
    case '/form-submit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method not allowed";
            exit;
        }

        // Handle form submission
        $errors = [];
        $formData = $_POST;

        // Validate required fields
        $requiredFields = ['name', 'phone', 'email', 'message', 'consent'];
        foreach ($requiredFields as $field) {
            if (empty($formData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required.';
            }
        }

        // Validate email
        if (!empty($formData['email']) && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format.';
        }

        // Validate phone pattern
        if (!empty($formData['phone']) && !preg_match('/^[0-9\s\-\+\(\)]{9,15}$/', $formData['phone'])) {
            $errors['phone'] = 'Invalid phone number format.';
        }

        // Validate reCAPTCHA
        $captchaService = new CaptchaService();
        try {
            $captchaResponse = $formData['g-recaptcha-response'] ?? '';
            if (!$captchaService->verify($captchaResponse, $_SERVER['REMOTE_ADDR'])) {
                $errors['captcha'] = 'reCAPTCHA verification failed. Please try again.';
            }
        } catch (Exception $e) {
            $errors['captcha'] = 'reCAPTCHA verification error: ' . $e->getMessage();
        }

        if (empty($errors)) {
            // Success - in a real app, you'd send email or save to DB
            $title = 'Form Submitted Successfully';
            $view = __DIR__ . '/../views/success.php';
        } else {
            // Errors - show form again with errors
            $title = 'Form';
            $view = __DIR__ . '/../views/form.php';
            $styles = [
                '/assets/css/form.css',
                '/assets/css/form-responsive.css'
            ];
            $scripts = [
                'https://www.google.com/recaptcha/api.js',
                '/assets/js/form.js'
            ];
            // Pass errors and form data to view
            $GLOBALS['formErrors'] = $errors;
            $GLOBALS['formData'] = $formData;
        }

        break;
        http_response_code(404);
        echo "Page not found";
        exit;
}

include __DIR__. '/../views/layout.php';