<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CASEAdmin\Controller\Admin' => 'CASEAdmin\Controller\AdminController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'caseadmin' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin2',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'CASEAdmin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
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
