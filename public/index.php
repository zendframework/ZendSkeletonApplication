<?php

$uri = $_SERVER['REQUEST_URI'];

$filePath = __DIR__ . '/' . $uri;

if (file_exists($filePath) && !is_dir($filePath)) {
    return false; // serve the requested resource as-is.
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
