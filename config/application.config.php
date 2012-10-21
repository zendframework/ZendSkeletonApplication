<?php
use \Zend\Stdlib\ArrayUtils;
return array(
    'modules' => array(
        'Application',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => ArrayUtils::merge(
	    array(
                './module',
                './vendor',
	    ),
	    explode(PATH_SEPARATOR, get_include_path())
        ),
    ),
);
