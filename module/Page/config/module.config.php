<?php
return array(
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
            /*
            'to' => array(
                'EMAIL HERE' => 'NAME HERE',
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
    ),
    'controllers' => array(
        'factories' => array(
            'PhlyContact\Controller\Contact' => 'PhlyContact\Service\ContactControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contact',
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
    'view_manager' => array(
        'template_map' => array(
            'page/contact/index' => __DIR__ . '/../view/page/contact/index.phtml',
            'page/contact/thank-you' => __DIR__ . '/../view/page/contact/thank-you.phtml'
        ),
        'template_path_stack' => array(
            'phly-contact' => __DIR__ . '/../view'
        )
    )
);
