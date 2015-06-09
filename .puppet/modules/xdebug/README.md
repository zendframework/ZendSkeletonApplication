puphpet-xdebug
=============

Puppet module for installing XDEBUG PHP Extension

Installs XDEBUG Support.
Depends on (tested with)
 - https://github.com/puphpet/puppet-php.git

Example usage:

    class { 'xdebug': }

To set up CGI/CLI specific INI files:

    xdebug::config { 'cgi': }
    xdebug::config { 'cli': }

Maintained by: PuPHPet

GitHub: git@github.com:puphpet/puphpet-xdebug.git

Original Author: Stefan Kögel

GitHub: git@github.com:stkoegel/puppet-xdebug.git
