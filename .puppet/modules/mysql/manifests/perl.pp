# Class: mysql::perl
#
# installs the perl bindings for mysql
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
class mysql::perl (
  $package_ensure   = 'present',
  $package_name     = $mysql::perl_package_name,
  $package_provider = $mysql::perl_package_provider
) inherits mysql {

  package{ 'perl_mysql':
    ensure   => $package_ensure,
    name     => $package_name,
    provider => $package_provider,
  }

}
