<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * This is configuration for the ZendDeveloperTools development toolbar.
 *
 * It will be enabled when you enable development mode.
 */
return [
    'zenddevelopertools' => [
        /**
         * General Profiler settings
         */
        'profiler' => [
            /**
             * Enables or disables the profiler.
             *
             * Expects: bool
             * Default: true
             */
            'enabled' => true,

            /**
             * Enables or disables the strict mode. If the strict mode is enabled, any error will throw an exception,
             * otherwise all errors will be added to the report (and shown in the toolbar).
             *
             * Expects: bool
             * Default: true
             */
            'strict' => true,

            /**
             * If enabled, the profiler tries to flush the content before the it starts collecting data. This option
             * will be ignored if the Toolbar is enabled.
             *
             * Note: The flush listener listens to the MvcEvent::EVENT_FINISH event with a priority of -9400. You have
             * to disable this function if you wish to modify the output with a lower priority.
             *
             * Expects: bool
             * Default: false
             */
            'flush_early' => false,

            /**
             * The cache directory is used in the version check and for every storage type that writes to the disk.
             * Note: The default value assumes that the current working directory is the application root.
             *
             * Expects: string
             * Default: 'data/cache'
             */
            'cache_dir' => 'data/cache',

            /**
             * If a matches is defined, the profiler will be disabled if the request does not match the pattern.
             *
             * Example: 'matcher' => array('ip' => '127.0.0.1')
             * OR
             * 'matcher' => array('url' => array('path' => '/admin')
             * Note: The matcher is not implemented yet!
             */
            'matcher' => [],

            /**
             * Contains a list with all collector the profiler should run. Zend Developer Tools ships with
             * 'db' (Zend\Db), 'time', 'event', 'memory', 'exception', 'request' and 'mail' (Zend\Mail). If you wish to
             * disable a default collector, simply set the value to null or false.
             *
             * Example: 'collectors' => array('db' => null)
             * Expects: array
             */
            'collectors' => [],
        ],
        'events' => [
            /**
             * Set to true to enable event-level logging for collectors that will support it. This enables a wildcard
             * listener onto the shared event manager that will allow profiling of user-defined events as well as the
             * built-in ZF events.
             *
             * Expects: bool
             * Default: false
             */
            'enabled' => true,

            /**
             * Contains a list with all event-level collectors that should run. Zend Developer Tools ships with 'time'
             * and 'memory'. If you wish to disable a default collector, simply set the value to null or false.
             *
             * Example: 'collectors' => array('memory' => null)
             * Expects: array
             */
            'collectors' => [],

            /**
             * Contains event identifiers used with the event listener. Zend Developer Tools defaults to listen to all
             * events. If you wish to disable the default all-inclusive identifier, simply set the value to null or
             * false.
             *
             * Example: 'identifiers' => array('all' => null, 'dispatchable' => 'Zend\Stdlib\DispatchableInterface')
             * Expects: array
             */
            'identifiers' => [],
        ],
        /**
         * General Toolbar settings
         */
        'toolbar' => [
            /**
             * Enables or disables the Toolbar.
             *
             * Expects: bool
             * Default: false
             */
            'enabled' => true,

            /**
             * If enabled, every empty collector will be hidden.
             *
             * Expects: bool
             * Default: false
             */
            'auto_hide' => false,

            /**
             * The Toolbar position.
             *
             * Expects: string ('bottom' or 'top')
             * Default: bottom
             */
            'position' => 'bottom',

            /**
             * If enabled, the Toolbar will check if your current Zend Framework version is up-to-date.
             * Note: The check will only occur once every hour.
             *
             * Expects: bool
             * Default: false
             */
            'version_check' => false,

            /**
             * Contains a list with all collector toolbar templates. The name  of the array key must be same as the name
             * of the collector.
             *
             * Example: 'profiler' => array(
             *  'collectors' => array(
             *      // My_Collector_Example::getName() -> mycollector
             *      'MyCollector' => 'My_Collector_Example',
             *  )
             * ),
             * 'toolbar' => array(
             *  'entries' => array(
             *      'mycollector' => 'example/toolbar/my-collector',
             *  )
             * ),
             * Expects: array
             */
            'entries' => [],
        ],
    ],
];
