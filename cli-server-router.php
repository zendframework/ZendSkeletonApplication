<?php
/** 
 * If you want to run under builtin-server, do command such as.
 *
 * php -S localhost:8000 -t public cli-server-router.php
 * OR
 * cd public && php -S localhost:8888 ../cli-server-router.php
 */

// Decline static file requests back to the PHP built-in webserver
if (is_file(__DIR__.'/public' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}
include __DIR__.'/public/index.php';
return true;
