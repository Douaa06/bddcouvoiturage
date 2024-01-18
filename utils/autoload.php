<?php
// En-têtes CORS
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
spl_autoload_register(function ($class) {
    $root = $_SERVER['DOCUMENT_ROOT'];   // adjust this to point to your root directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require_once $file;
    }
});
