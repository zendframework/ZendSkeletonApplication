service { 'nginx':
  ensure     => running,
  enable     => true,
  hasrestart => true,
  hasstatus  => true,
}

puphpet::ini { 'custom_php':
  value   => ['date.timezone = "America/Chicago"'],
  ini     => '/etc/php5/cgi/conf.d/custom_php.ini',
  notify  => Service['nginx'],
}