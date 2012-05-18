<?php
chdir(dirname(__DIR__));
<<<<<<< HEAD
require_once (getenv('ZF2_PATH') ?: 'vendor/ZendFramework/library') . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory();

use Zend\Loader\AutoloaderFactory,
Zend\ServiceManager\ServiceManager,
Zend\Mvc\Service\ServiceManagerConfiguration;

// setup autoloader
AutoloaderFactory::factory();
=======
require_once('vendor/autoload.php');

$appConfig        = include 'config/application.config.php';
$sharedEvents     = new Zend\EventManager\SharedEventManager();
$listenerOptions  = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
$defaultListeners = new Zend\Module\Listener\DefaultListenerAggregate($listenerOptions);
$defaultListeners->getConfigListener()->addConfigGlobPath("config/autoload/*.php");
>>>>>>> c994772... Added composer.lock to git.

// get application stack configuration
$configuration = include 'config/application.config.php';

// setup service manager
$serviceManager = new ServiceManager(new ServiceManagerConfiguration($configuration['service_manager']));
$serviceManager->setService('ApplicationConfiguration', $configuration);
$serviceManager->get('ModuleManager')->loadModules();

// run application
$serviceManager->get('Application')->bootstrap()->run()->send();
