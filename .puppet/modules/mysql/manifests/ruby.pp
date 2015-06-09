# Class: mysql::ruby
#
# installs the ruby bindings for mysql
#
# Parameters:
#   [*package_ensure*]   - Ensure state for package. Can be specified as version.
#   [*package_name*]     - name of package
#   [*package_provider*] - The provider to use to install the package
#
# Actions:
#
# Requires:
#
# Sample Usage:
#
class mysql::ruby (
  $package_ensure   = 'present',
  $package_name     = $mysql::ruby_package_name,
  $package_provider = $mysql::ruby_package_provider
) inherits mysql {

  package{ 'ruby_mysql':
    ensure   => $package_ensure,
    name     => $package_name,
    provider => $package_provider,
  }

}
