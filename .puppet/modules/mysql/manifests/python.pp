# Class: mysql::python
#
# This class installs the python libs for mysql.
#
# Parameters:
#   [*package_ensure*] - Ensure state for package. Can be specified as version.
#   [*package_name*]   - Name of package
#
# Actions:
#
# Requires:
#
# Sample Usage:
#
class mysql::python(
  $package_ensure = 'present',
  $package_name   = $mysql::python_package_name
) inherits mysql {

  package { 'python-mysqldb':
    ensure => $package_ensure,
    name   => $package_name,
  }

}
