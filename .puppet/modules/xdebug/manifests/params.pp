class xdebug::params {

  $pkg = $operatingsystem ? {
    /Debian|Ubuntu/ => 'php5-xdebug',
  }

  $php = $operatingsystem ? {
    /Debian|Ubuntu/ => 'php5-cli',
  }
}
