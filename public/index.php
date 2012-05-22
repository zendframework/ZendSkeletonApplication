<?php
use Zend\ServiceManager\ServiceManager,
    Zend\Mvc\Service\ServiceManagerConfiguration;

chdir(dirname(__DIR__));

if (!file_exists('vendor/autoload.php')) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run php composer.phar install?');
    exit;
}

// Composer autoloading
require_once('vendor/autoload.php');

// Get application stack configuration
$configuration = include 'config/application.config.php';

// Setup service manager
$serviceManager = new ServiceManager(new ServiceManagerConfiguration($configuration['service_manager']));
$serviceManager->setService('ApplicationConfiguration', $configuration);
$serviceManager->get('ModuleManager')->loadModules();

// Run application
$serviceManager->get('Application')->bootstrap()->run()->send();
