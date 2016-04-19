<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use Zend\Mvc\Application;

// Composer autoloading
include 'vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install`.');
}
