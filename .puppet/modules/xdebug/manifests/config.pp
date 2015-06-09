define xdebug::config (
  $default_enable        = 1,
  $remote_autostart      = 1,
  $remote_connect_back   = 1,
  $remote_enable         = 1,
  $remote_handler        = 'dbgp',
  $remote_host           = $ipaddress_eth1,
  $remote_mode           = 'req',
  $remote_port           = 9000,
  $show_exception_trace  = 0,
  $show_local_vars       = 0,
  $var_display_max_data  = 10000,
  $var_display_max_depth = 20,
  $ini_file              = undef,
  $template              = 'xdebug/ini.erb',
  $service               = $php::service
) {

  if (!$ini_file) {
    # guess the ini file as fallback
    if $name == 'cgi' {
      $ini_file_real = "${php::config_dir}/${php::service}/php.ini"
    } elsif $name == 'cli' {
      $ini_file_real = "${php::config_dir}/cli/php.ini"
    } else {
      $ini_file_real = "${php::config_file}"
    }
  } else {
    $ini_file_real = $ini_file
  }

  file { $ini_file_real:
    ensure   => file,
    replace  => true,
    owner    => root,
    group    => root,
    mode     => '0644',
    content  => template($template),
    notify   => Service[$service],
  }

  # shortcut for xdebug CLI debugging
  if ! defined(File['/usr/bin/xdebug']) {
    file { '/usr/bin/xdebug':
      ensure => 'present',
      mode   => '+X',
      source => 'puppet:///modules/xdebug/cli_alias.erb'
    }
  }

}
