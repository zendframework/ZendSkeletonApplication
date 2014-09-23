<?php
return [
    'modules' => [
        'Application'
    ],
    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php'
        ],
        // cache configs for production
        //'config_cache_enabled' => $booleanValue,
        //'config_cache_key' => app.cache,
        //'module_map_cache_enabled' => true,
        //'module_map_cache_key' => app.module.cache,
    ]
];
