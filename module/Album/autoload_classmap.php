<?php
/*
 * As we are in development, we dont need to load files via the classmap, so we provide an empty array for the classmap
 */
return array ();
/*
 * As this is an empty array, whenever the autoloader looks for a class within the Album namespace, it will fall back to
the to StandardAutoloader for us.
 */


/*
 * Note: If you are using Composer, you could instead just create an empty getAutoloaderConfig() { } and
add to composer.json:

"autoload": {
"psr-0": { "Album": "module/Album/src/" }
},
If you go this way, then you need to run php composer.phar update to update the composer autoloading files.
 */