<?php
return array(
    'diagnostics' => array(
        'application' => array(
            // invoke php built-in function with a parameter
            'Check if public dir exists' => array('file_exists', 'public/'),
            'Verify Disk Space' => array('CASEBaseDiagnostics\Test\DiskSpace','1GB'), 
         ),
     ),
    /**
     * Enable diagnostics route
     */
    'router' => array(
        'routes' => array(
            'zftool-diagnostics' => array(
                'type'  => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/diagnostics',
                    'defaults' => array(
                        'controller' => 'ZFTool\Controller\Diagnostics',
                        'action'     => 'run'
                    )
                )
            )
        )
    ),
    /**
     * Enable diagnostic route in bjauthorize as guest
     */
    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'zftool-diagnostics',
                    'roles' => array(
                        'guest',
                    )
                ),
            )
        )
    )
);
