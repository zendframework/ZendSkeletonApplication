<?php
namespace CASEDevelopment;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/config/module.config.php', 
            //include __DIR__ . '/config/doctrine.config.php', 
            include __DIR__ . '/config/zenddevelopertools.config.php', 
            include __DIR__ . '/config/whoops.config.php'
        );
    }

    public function onBootstrap(MvcEvent $e)
    {}
}
