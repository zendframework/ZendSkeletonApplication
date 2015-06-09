ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Installation using Composer
---------------------------

The easiest way to create a new ZF2 project is to use [Composer](https://getcomposer.org/). If you don't have it already installed, then please install as per the [documentation](https://getcomposer.org/doc/00-intro.md).


Create your new ZF2 project:

    composer create-project -n -sdev zendframework/skeleton-application path/to/install



### Installation using a tarball with a local composer

If you don't have composer installed globally then another way to create a new ZF2 project is to download the tarball and install it:

1. Download the [tarball](https://github.com/zendframework/ZendSkeletonApplication/tarball/master), extract it and then install the dependencies with a locally installed Composer:

        cd my/project/dir
        curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1
    

2. Download composer into your proejct directory and install the dependencies:

        curl -s https://getcomposer.org/installer | php
        php composer.phar install

If you don't have access to curl, then install Composer into your project as per the [documentation](https://getcomposer.org/doc/00-intro.md).


Web Server Setup
----------------

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root
directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note:** The built-in CLI server is *for development only*.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName zf2-tutorial.localhost
        DocumentRoot /path/to/zf2-tutorial/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/zf2-tutorial/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
            <IfModule mod_authz_core.c>
            Require all granted
            </IfModule>
        </Directory>
    </VirtualHost>