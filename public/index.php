<?php

use Zend\Mvc\Application;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include 'vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install`.');
}

// Run the application!
Application::init(require 'config/application.config.php')->run();
