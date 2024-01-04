<?php
spl_autoload_register(function ($class) {
    $root = $_SERVER['DOCUMENT_ROOT'];   // adjust this to point to your root directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require_once $file;
    }
});
