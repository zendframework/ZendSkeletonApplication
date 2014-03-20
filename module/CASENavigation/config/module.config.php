<?php
return array(
    'navigation' => array(
        // The DefaultNavigationFactory we configured in (1) uses 'default' as the sitemap key
        'default' => array(
            // And finally, here is where we define our page hierarchy
            'home' => array(
                'label' => 'Home',
                'route' => 'home',
            ),
            'account' => array(
                'label' => 'Account',
                'route' => 'zfcuser',
                'pages' => array(
                    'home' => array(
                        'label' => 'Dashboard',
                        'route' => 'zfcuser',
                        'pages' => array(
                            'change-password' => array(
                                'label' => 'Change password',
                                'route' => 'zfcuser/changepassword'
                            ),
                            'change-email' => array(
                                'label' => 'Change email',
                                'route' => 'zfcuser/changeemail'
                            )
                        )
                    ),
                    //Menu only for guests
                    'login' => array(
                        'label' => 'Sign In',
                        'route' => 'zfcuser/login'
                    ),
                    //Menu only for users
                    'logout' => array(
                        'label' => 'Sign Out',
                        'route' => 'zfcuser/logout'
                    ),
                    //Menu only for guests
                    'register' => array(
                        'label' => 'Register',
                        'route' => 'zfcuser/register'
                    ),
                ),
            ),
            //Menu only for administrators
            'admin' => array(
                'label' => 'Admin',
                'route' => 'zfcadmin',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        ),
    ),
);
