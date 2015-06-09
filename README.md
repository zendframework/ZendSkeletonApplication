ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Installation
------------

There are several options available for installing projects with Composer. If you don't already have it installed,
the Composer installer script will check some php.ini settings, warn you if they are set incorrectly, and then download
the latest composer.phar in the current directory.

For Composer documentation, please refer to [getcomposer.org](https://getcomposer.org/)

Here are a few recipes to choose from:

### Option 1 (via curl and composer create-project)

The recommended way to get a working copy of this project is to clone the repository and use `composer` to install
dependencies using the `create-project` command:

    curl -s https://getcomposer.org/installer | php
    php composer.phar create-project -n -sdev zendframework/skeleton-application path/to/install
    mv composer.phar path/to/install
    cd path/to/install

### Option 2 (via php readfile and composer create-project)

Or if you don't have curl:

    php -r "readfile('https://getcomposer.org/installer');" | php
    php composer.phar create-project -n -sdev zendframework/skeleton-application path/to/install
    mv composer.phar path/to/install
    cd path/to/install

### Option 3 (via curl and tar and composer install)

An alternative for downloading the project is to grab it via `curl`, and then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/zendframework/ZendSkeletonApplication/tarball/master | tar xz --strip-components=1

You would then install and invoke `composer` to install dependencies manually:

    curl -s https://getcomposer.org/installer | php
    php composer.phar install
    
### Option 4 (via php readfile and composer install)

Or if you don't have curl:

    git clone https://github.com/zendframework/ZendSkeletonApplication.git path/to/install
    cd path/to/install
    
You would then install and invoke `composer` to install dependencies manually:

    php -r "readfile('https://getcomposer.org/installer');" | php
    php composer.phar install

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
        </Directory>
    </VirtualHost>
