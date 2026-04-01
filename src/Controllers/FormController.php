<?php

namespace App\Controllers;

class FormController {
    public function index(): void {
        $title = 'Form';

        $styles = [
            '/assets/css/form.css',
            '/assets/css/form-responsive.css'
        ];

        $scripts = [
            'https://www.google.com/recaptcha/api.js',
            '/assets/js/form.js'
        ];

        $view = __DIR__ . '/../../views/form.php';
        include __DIR__ . '/../../views/layout.php';
    }
}