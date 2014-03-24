<?php
return array(
    'EnliteMonolog' => array(
        // Logger name
        'EnliteMonologService' => array(
            // name of
            'name' => 'default',
            // Handlers, it can be service manager alias(string) or config(array)
            'handlers' => array(
                'default' => array(
                    'name' => 'Monolog\Handler\StreamHandler',
                    'args' => array(
                        //'path' => 'data/log/application.log',
                        'path' => '/tmp/application.log',
                        'level' => \Monolog\Logger::DEBUG,
                        'bubble' => true
                    )
                )
            )
        )
    ),    
);
