<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CASEAdmin\Controller\Admin' => 'CASEAdmin\Controller\AdminController',
        ),
    ),
    'router' => array(
        'routes' => array(
            /**
             * Inyects a route into the admin panel
             * https://github.com/ZF-Commons/ZfcAdmin/blob/master/docs/2.Routes.md
             */
            'zfcadmin' => array(
                'child_routes' => array(
                    'case_admin' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/case',
                            'defaults' => array(
                                'controller' => 'CASEAdmin\Controller\Admin',
                                'action' => 'index'
                            )
                        )
                    )
                )
            ),
        ),
    ),
    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'zfcadmin/case_admin',
                    'roles' => array(
                        'administrator'
                    )
                )
            )
            
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CASEAdmin' => __DIR__ . '/../view',
        ),
    ),
    
    /**
     * Add a navigation item to the admin module
     */
    'navigation' => array(
        'admin' => array(
            'case_admin' => array(
                'label' => 'CASEAdmin',
                'route' => 'zfcadmin/case_admin',
            ),
        ),
    ),
);
