<?php
/**
 * @see       https://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2019 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/ZendSkeletonApplication/blob/master/LICENSE.md New BSD License
 */

$gitIgnore = sprintf('%s/.gitignore', realpath(dirname(__DIR__)));
$rules     = file_get_contents($gitIgnore);
$rules     = preg_replace("#[\r\n]+composer.lock#s", '', $rules);
file_put_contents($gitIgnore, $rules);
unlink(__FILE__);
