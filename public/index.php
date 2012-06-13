<?php
use Zend\Loader\AutoloaderFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfiguration;

chdir(dirname(__DIR__));

// Allow using an alternative copy of ZF2
if (getenv('ZF2_PATH')) {
    require_once getenv('ZF2_PATH') . '/Zend/Loader/AutoloaderFactory.php';
    AutoloaderFactory::factory();
}

// Composer autoloading
if (!include_once('vendor/autoload.php')) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

// Get application stack configuration
$configuration = include 'config/application.config.php';

// Setup service manager
$serviceManager = new ServiceManager(new ServiceManagerConfiguration($configuration['service_manager']));
$serviceManager->setService('ApplicationConfiguration', $configuration);
$serviceManager->get('ModuleManager')->loadModules();

// Run application
$serviceManager->get('Application')->bootstrap()->run()->send();
