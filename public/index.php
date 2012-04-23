<?php
chdir(dirname(__DIR__));
require_once (getenv('ZF2_PATH') ?: 'vendor/ZendFramework/library') . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory();

$appConfig = include 'config/application.config.php';

$sharedEvents     = new Zend\EventManager\SharedEventManager();
$listenerOptions  = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
$defaultListeners = new Zend\Module\Listener\DefaultListenerAggregate($listenerOptions);
$defaultListeners->getConfigListener()->addConfigGlobPath("config/autoload/*.php");
    

$moduleManager = new Zend\Module\Manager($appConfig['modules']);
$events        = $moduleManager->events();
$events->setSharedCollections($sharedEvents);
$events->attach($defaultListeners);
$moduleManager->loadModules();

// Create application, bootstrap, and run
$bootstrap   = new Zend\Mvc\Bootstrap($defaultListeners->getConfigListener()->getMergedConfig());
$bootstrap->events()->setSharedCollections($sharedEvents);
$application = new Zend\Mvc\Application;
$bootstrap->bootstrap($application);
$application->run()->send();
