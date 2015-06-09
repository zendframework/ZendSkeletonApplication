define composer::run (
  $path,
  $command = 'install'
) {

  include composer

  exec { "${composer::filename} ${command} --working-dir ${path}":
    environment => "COMPOSER_HOME=${composer::install_location}",
    path        => ['/usr/bin', '/bin', $composer::install_location],
    require     => Package['php'],
  }
}
