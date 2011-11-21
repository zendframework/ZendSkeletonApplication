<?php
return array(
    'module_paths' => array(
        realpath(dirname(__DIR__) . '/module'),
        realpath(dirname(__DIR__) . '/vendor'),
    ),
    'modules' => array(
        'Application',
    ),
    'module_listener_options' => array( 
        'config_cache_enabled'    => false,
        'cache_dir'               => realpath(dirname(__DIR__) . '/data/cache'),
        'application_environment' => getenv('APPLICATION_ENV'),
    ),
);
