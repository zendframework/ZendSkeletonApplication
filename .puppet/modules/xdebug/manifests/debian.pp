class xdebug::debian {

  include xdebug::params
    
  package { 'xdebug':
    name   => $xdebug::params::pkg,
    ensure => installed,
    require => Class['php'],
  }

}
