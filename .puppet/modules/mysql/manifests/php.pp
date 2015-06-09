# Class: mysql::php
#
# This class installs the php libs for mysql.
#
# Parameters:
#   [*package_ensure*]   - Ensure state for package. Can be specified as version.
#   [*package_name*]     - The name of package
#
class mysql::php(
  $package_ensure = 'present',
  $package_name   = $mysql::php_package_name
) inherits mysql {

  package { 'php-mysql':
    ensure => $package_ensure,
    name   => $package_name,
  }

}
