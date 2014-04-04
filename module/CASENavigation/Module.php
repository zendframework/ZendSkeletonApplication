<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/CASENavigation for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CASENavigation;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\Navigation as ZendViewHelperNavigation;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements AutoloaderProviderInterface, ViewHelperProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    

    public function onBootstrap(MvcEvent $e)
    {
        /**
            Si estamos usando bjyauthorize le seteamos el al navigation
            el default acl y el role
            
         */
        $sm = $e->getApplication()->getServiceManager();
        if($sm->has('BjyAuthorizeServiceAuthorize')){
            $authorize = $sm->get('BjyAuthorizeServiceAuthorize');
            $acl = $authorize->getAcl();
            $role = $authorize->getIdentity();
            
            ZendViewHelperNavigation::setDefaultAcl($acl);
            ZendViewHelperNavigation::setDefaultRole($role);
        }
    }
    
	/* (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\ViewHelperProviderInterface::getViewHelperConfig()
     */
    public function getViewHelperConfig()
    {
        return [
            'delegators' => [
                	
            ]
        ];
        
    }

}
