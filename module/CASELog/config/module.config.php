<?php
/**
 * @see https://github.com/enlitepro/enlite-monolog
 * @see https://github.com/Seldaek/monolog
 */
return array(
    'EnliteMonolog' => array(
        // Logger name
        'Logger' => array(
            // name of
            'name' => 'CaseLogger',
            // Handlers, it can be service manager alias(string) or config(array)
            'handlers' => array(
                'default' => array(
                    'name' => 'Monolog\Handler\StreamHandler',
                    'args' => array(
                        'path' => 'data/log/application.log', 
                        'level' => \Monolog\Logger::ALERT,
                        
                        'bubble' => true
                    ),
                ),
            ),
        ),
        //http://craig.is/writing/chrome-logger
//         'ChromeLogger' => array(
//             'name' => 'CASEChromeLogger',
//             'handlers' => array(
//                 array(
//                     'name' => 'Monolog\Handler\ChromePHPHandler',
//                 ),
//             ),
//         ),
    ),
);
