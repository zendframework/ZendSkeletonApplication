<?php
use Zend\Loader\AutoloaderFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfiguration;

chdir(dirname(__DIR__));

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
    $loader = include 'vendor/autoload.php';
}

// Support for ZF2_PATH environment variable or git submodule
if ($zf2Path = getenv('ZF2_PATH') ?: (is_dir('vendor/ZF2/library') ? 'vendor/ZF2/library' : false)) {
    if (isset($loader)) {
        $loader->add('Zend', $zf2Path . '/Zend');
    } else {
        include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true
            )
        ));
    }
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}

// Get application stack configuration
$configuration = include 'config/application.config.php';

// Setup service manager
$serviceManager = new ServiceManager(new ServiceManagerConfiguration($configuration['service_manager']));
$serviceManager->setService('ApplicationConfiguration', $configuration);
$serviceManager->get('ModuleManager')->loadModules();

// Run application
$serviceManager->get('Application')->bootstrap()->run()->send();
