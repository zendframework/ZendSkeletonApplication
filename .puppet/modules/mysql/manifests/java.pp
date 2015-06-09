# Class: mysql::java
#
# This class installs the mysql-java-connector.
#
# Parameters:
#   [*package_name*]       - The name of the mysql java package.
#   [*package_ensure*]     - Ensure state for package. Can be specified as version.
# Actions:
#
# Requires:
#
# Sample Usage:
#
class mysql::java (
  $package_ensure = 'present',
  $package_name   = $mysql::java_package_name
) inherits mysql {

  package { 'mysql-connector-java':
    ensure => $package_ensure,
    name   => $package_name,
  }

}
