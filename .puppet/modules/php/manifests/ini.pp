define php::ini (
    $value    = '',
    $template = 'extra-ini.erb',
    $target   = 'extra.ini',
    $service  = $php::service
) {

  include php

  $config_dir = params_lookup( 'config_dir' )

  file { "${config_dir}/conf.d/${target}":
    ensure  => 'present',
    content => template("php/${template}"),
    require => Package['php'],
    notify  => Service[$service],
  }

  file { "${config_dir}/cli/conf.d/${target}":
    ensure  => 'present',
    content => template("php/${template}"),
    require => Package['php'],
  }

}
