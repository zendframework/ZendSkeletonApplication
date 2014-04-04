<?php
return array(
    'navigation' => array(
        // The DefaultNavigationFactory we configured in (1) uses 'default' as the sitemap key
        'default' => array(
            // And finally, here is where we define our page hierarchy
            'home' => array(
                'label' => 'Home',
                'route' => 'home',
                'resource' => 'route/home'
            ),
            'login' => array(
                // Menu only for guests
                'label' => 'Sign In',
                'route' => 'zfcuser/login',
                'resource'  => 'route/zfcuser/login',
                 
            ),
            // Menu only for guests
            'register' => array(
                'label' => 'Register',
                'route' => 'zfcuser/register',
                'resource' => 'route/zfcuser/register'
            ),
            'account' => array(
                'label' => 'Account',
                'route' => 'zfcuser',
                'resource' => 'route/zfcuser',
                'pages' => array(
                    'home' => array(
                        'label' => 'Dashboard',
                        'route' => 'zfcuser',
                        'resource' => 'route/zfcuser',
                        'pages' => array(
                            'change-password' => array(
                                'label' => 'Change password',
                                'route' => 'zfcuser/changepassword',
                                'resource' => 'route/zfcuser/changepassword'
                            ),
                            'change-email' => array(
                                'label' => 'Change email',
                                'route' => 'zfcuser/changeemail',
                                'resource' => 'route/zfcuser/changeemail'
                            )
                        )
                    ),
                    // Menu only for users
                    'logout' => array(
                        'label' => 'Sign Out',
                        'route' => 'zfcuser/logout',
                        'resource' => 'route/zfcuser/logout'
                    ),
                )
            ),
            // Menu only for administrators
            'admin' => array(
                'label' => 'Admin',
                'route' => 'zfcadmin',
                'resource' => 'route/zfcadmin'
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    )
);
