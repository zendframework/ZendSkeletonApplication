<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * All good, skip the rest of the file
 */
if (class_exists('Zend\Loader\AutoloaderFactory') && is_file('config/autoload/local.php')) {
    return;
}

/**
 * Load framework
 */
if ((is_dir('vendor/zendframework') || is_dir('vendor/ZF2')) && is_file('vendor/autoload.php')) {
    $loader = include 'vendor/autoload.php';
    $loader->add('Zend', 'vendor/zendframework');
}

/**
 * Check for Zend setup and database setup
 */
if (!class_exists('Zend\Loader\AutoloaderFactory') || !is_file('config/autoload/local.php')) {
    if (!is_file('public/install.php')) {
        die(sprintf('Installation file is missing. Process cannot be started.'));
    }
    header('Location: /install.php');
    die;
}
