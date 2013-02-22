<?php

// Setup autoloading
require 'init_autoloader.php';

$base = new \Zend\View\Helper\BasePath();
$base->setBasePath("public/");

// Run the application!
$app = Zend\Mvc\Application::init(require "config/application.config.php");

$app->getRequest()->setBasePath("/public/");

$app->run();
