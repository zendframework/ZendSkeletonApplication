ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. 
This Seklleton have some other modules preconfigured like Doctrine, ZfcUser, etc.


Installation
------------

Using Composer (recommended)
----------------------------
Clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/AV4TAr/ZendSkeletonApplication.git
    cd ZendSkeletonApplication
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

You would then invoke `composer` to install dependencies per the previous example.

This will install:

 - DoctrineModule & DoctrineORMModule
 - ZfcBase & ZfcUser: https://github.com/ZF-Commons/ZfcUser 
 - ZfcUserDoctrineORM
 - CASEBase
 - CASEAdmin


Web Server Setup
----------------


### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName application.dev
        DocumentRoot /path/to/zf2-application/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/zf2-application/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

### Database Setup


Application Setup
-----------------

#### Doctrine Setup

Copy 

	/config/autoload/local.php.dist 
to 

	/config/autoload/local.php 
and update the params sub-array

	'params' => array (
		'host' => 'localhost',
		'port' => '3306',
		'user' => 'root',
		'password' => 'root',
		'dbname' => 'database' 
	) 

Update the database schema using cli:

	~ ./vendor/bin/doctrine-module orm:schema-tool:update --force
###Development mode

Copy 

	/config/development.config.php.dist 
to 

	/config/development.config.php
That will activate ZFTool and the ZendDevloperTools bar.

#Features
##User Management
 - Login: /user/login
 - Registration: /user/register
 - Change email: /user/change-email
 - Change Password: /user/change-password
 
##Admin Panel
 - Entrypoint: /admin
