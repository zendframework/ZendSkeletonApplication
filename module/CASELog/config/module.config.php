<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CASELog\Controller\Log' => 'CASELog\Controller\LogController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'case-log' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/log',
                    'defaults' => array(
                        '__NAMESPACE__' => 'CASELog\Controller',
                        'controller'    => 'Log',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CASELog' => __DIR__ . '/../view',
        ),
    ),
    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'case-log',
                    'roles' => array(
                        'administrator',
                    )
                ),
            )
        )
    )
);
