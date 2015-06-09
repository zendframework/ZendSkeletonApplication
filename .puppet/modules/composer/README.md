# Puppet module: composer

This is a Puppet module for [Composer](http://getcomposer.org)

Requires PHP, curl and Git

## USAGE - Basic management

Install Composer and run it against a composer.json file

    class { 'composer': }

    composer::run { 'puphpet':
      path => '/var/www/puphpet.dev/',
    }
