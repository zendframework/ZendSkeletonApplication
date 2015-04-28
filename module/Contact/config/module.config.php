<?php
return array(
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contact-me',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PhlyContact\Controller',
                        'controller' => 'Contact',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process',
                            'defaults' => array(
                                'action' => 'process'
                            )
                        )
                    ),
                    'thank-you' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/thank-you',
                            'defaults' => array(
                                'action' => 'thank-you'
                            )
                        )
                    )
                )
            )
        )
    ),
    'phly_contact' => array(
        'captcha' => array(
            'class' => 'dumb'
        ),
        'form' => array(
            'name' => 'contact'
        ),
        'mail_transport' => array(
            'class' => 'Zend\Mail\Transport\Sendmail',
            'options' => array()
        ),
        'message' => array(
            'to' => array(
                'vrkansagara@gmail.com' => 'Vallabh Kansagara',
                /*
                 ),
    'sender' => array(
    		'address' => 'EMAIL HERE',
    		'name'    => 'NAME HERE',
    ),
    'from' => array(
    		'EMAIL HERE' => 'NAME HERE',
    ),
    */
            )
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'contact/contact/index' => __DIR__ . '/../view/contact/contact/index.phtml',
            'contact/contact/thank-you' => __DIR__ . '/../view/contact/contact/thank-you.phtml'
        ),
        'template_path_stack' => array(
            'contact' => __DIR__ . '/../view'
        )
    )
);