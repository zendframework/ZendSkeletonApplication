# = Define: php::module
#
# This define installs and configures php modules
# On Debian and derivatives it install module named php5-${name}
# On RedHat and derivatives it install module named php-${name}
# If you need a custom prefix you can overload default $module_prefix parameter
#
# == Parameters
#
# [*version*]
#   Version to install.
#
# [*absent*]
#   true to ensure package isn't installed.
#
# [*notify_service*]
#   If you want to restart a service automatically when
#   the module is applied. Default: true
#
# [*service_autorestart*]
#   whatever we want a module installation notify a service to restart.
#
# [*service*]
#   Service to restart.
#
# [*module_prefix*]
#   If package name prefix isn't standard.
#
# == Examples
# php::module { 'gd': }
#
# php::module { 'gd':
#   ensure => absent,
# }
#
# This will install php-apc on debian instead of php5-apc
#
# php::module { 'apc':
#   module_prefix => "php-",
# }
#
# Note that you may include or declare the php class when using
# the php::module define
#
define php::module (
  $version             = $php::version,
  $service_autorestart = $php::bool_service_autorestart,
  $service             = $php::service,
  $module_prefix       = $php::module_prefix,
  $absent              = $php::absent
  ) {

  if $absent {
    $real_version = "absent"
  } else {
    $real_version = $version
  }

  $manage_service_autorestart = $service_autorestart ? {
    true    => "Service[${service}]",
    false   => undef,
  }

  $real_install_package = "${module_prefix}${name}"

  package { "PhpModule_${name}":
    ensure  => $real_version,
    name    => $real_install_package,
    notify  => $manage_service_autorestart,
    require => Package['php'],
  }

}
