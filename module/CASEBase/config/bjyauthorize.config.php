<?php
return array(
    'bjyauthorize' => array(
        
        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',

        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
        * roles the "identity role" should inherit from.
        *
        * for ZfcUser, this will be your default identity provider
        */
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',

        /* If you only have a default role and an authenticated role, you can
         * use the 'AuthenticationIdentityProvider' to allow/restrict access
        * with the guards based on the state 'logged in' and 'not logged in'.
        *
        * 'default_role'       => 'guest',         // not authenticated
        * 'authenticated_role' => 'user',          // authenticated
        * 'identity_provider'  => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        */

        /*
         * role providers simply provide a list of roles that should be inserted into the Zend\Acl instance. the module comes with two providers, 
         * one to specify roles in a config file and one to load roles using a Zend\Db adapter.
         */
        'role_providers' => array(

                // using an object repository (entity repository) to load all roles into our ACL
                'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                    'object_manager'    => 'doctrine.entitymanager.orm_default',
                    'role_entity_class' => 'CASEBase\Entity\Role',

            ),
            
            
        ),
        
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
//                 'pants' => array()
            )
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
        * assertions will be loaded using the service manager and must implement
        * Zend\Acl\Assertion\AssertionInterface.
        * *if you use assertions, define them using the service manager!*
        */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    array( array('guest'), 'route/zfcuser/login', array()),
                    array( array('guest'), 'route/zfcuser/register', array()),
                    
                    array( array('user'), 'route/zfcuser', array()),
                    array( array('user'), 'route/zfcuser/changepassword', array()),
                    array( array('user'), 'route/zfcuser/changeemail', array()),
                    array( array('user'), 'route/zfcuser/logout', array()),
                    array( array('user'), 'route/zfcuser/logout', array()),
                ),
                
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    array( array('user'), 'route/zfcuser/login', array()),
                    array( array('user'), 'route/zfcuser/register', array()),
                )
            // ...
            )
        )
        ,

        /* Currently, only controller and route guards exist
         *
        * Consider enabling either the controller or the route guard depending on your needs.
        */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
            * You may omit the 'action' index to allow access to the entire controller
            */
            /*
            'BjyAuthorize\Guard\Controller' => array(
                array(
                    'controller' => 'index',
                    'action' => 'index',
                    'roles' => array(
                        'guest',
                        'user'
                    )
                ),
                array(
                    'controller' => 'index',
                    'action' => 'stuff',
                    'roles' => array(
                        'user'
                    )
                ),
                // You can also specify an array of actions or an array of controllers (or both)
                // allow "guest" and "admin" to access actions "list" and "manage" on these "index",
                // "static" and "console" controllers
                array(
                    'controller' => array(
                        'index',
                        'static',
                        'console'
                    ),
                    'action' => array(
                        'list',
                        'manage'
                    ),
                    'roles' => array(
                        'guest',
                        'admin'
                    )
                ),
                array(
                    'controller' => array(
                        'search',
                        'administration'
                    ),
                    'roles' => array(
                        'staffer',
                        'admin'
                    )
                ),
                array(
                    'controller' => 'zfcuser',
                    'roles' => array()
                )
            // Below is the default index action used by the ZendSkeletonApplication
            // array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
                        ),
            */
            
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
            */
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'zfcuser',
                    'roles' => array(
                        'user'
                    )
                ),
                array(
                    'route' => 'zfcuser/changepassword',
                    'roles' => array(
                        'user'
                    )
                ),
                array(
                    'route' => 'zfcuser/changeemail',
                    'roles' => array(
                        'user'
                    )
                ),
                array(
                    'route' => 'zfcuser/logout',
                    'roles' => array(
                        'user'
                    )
                ),
                array(
                    'route' => 'zfcuser/login',
                    'roles' => array(
                        'guest'
                    )
                ),
                array(
                    'route' => 'zfcuser/register',
                    'roles' => array(
                        'guest'
                    )
                ),
                // Below is the default index action used by the ZendSkeletonApplication
                array(
                    'route' => 'home',
                    'roles' => array(
                        'guest',
                        'user'
                    )
                ),
                array(
                    'route' => 'zfcadmin',
                    'roles' => array(
                        'administrator',
                    )
                )
            )
        )
    )
);