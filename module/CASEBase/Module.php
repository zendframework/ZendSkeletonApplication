<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/CASEBase for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace CASEBase;

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
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/config/module.config.php'
            , include __DIR__ . '/config/bjyauthorize.config.php'
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        
        $sm = $e->getApplication()->getServiceManager();
        
        /**
         * Registered Users have default role: user
         */
        //https://github.com/ZF-Commons/ZfcUser/wiki/How-to-perform-a-custom-action-when-a-new-user-account-is-created
        $shem = $sm->get('SharedEventManager');
        $shem->attach('ZfcUser\Service\User', 'register', function($e) use ($sm) {
            $user = $e->getParam('user');  // User account object
            $roleService = $sm->get('CASEBase\Service\RoleService');
            $role = $roleService->findByRoleName('user');
            $user->addRole($role);
        });
        
        

    }
}
