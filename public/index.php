<?php
require_once dirname(__DIR__) . '/vendor/ZendFramework/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array()));

$appConfig = include dirname(__DIR__) . '/config/application.config.php';

$moduleLoader = new Zend\Loader\ModuleAutoloader($appConfig['module_paths']);
$moduleLoader->register();

$moduleManager = new Zend\Module\Manager($appConfig['modules']);
$listenerOptions = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
$moduleManager->setDefaultListenerOptions($listenerOptions);
$moduleManager->getConfigListener()->addConfigGlobPath(dirname(__DIR__) . '/config/autoload/*.config.php');
$moduleManager->loadModules();

// Create application, bootstrap, and run
$bootstrap   = new Zend\Mvc\Bootstrap($moduleManager->getMergedConfig());
$application = new Zend\Mvc\Application;
$bootstrap->bootstrap($application);
$application->run()->send();
