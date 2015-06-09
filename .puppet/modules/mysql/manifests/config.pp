# Class: mysql::config
#
# Parameters:
#
#   [*root_password*]       - root user password.
#   [*old_root_password*]   - previous root user password,
#   [*bind_address*]        - address to bind service.
#   [*port*]                - port to bind service.
#   [*etc_root_password*]   - whether to save /etc/my.cnf.
#   [*service_name*]        - mysql service name.
#   [*config_file*]         - my.cnf configuration file path.
#   [*socket*]              - mysql socket.
#   [*datadir*]             - path to datadir.
#   [*ssl]                  - enable ssl
#   [*ssl_ca]               - path to ssl-ca
#   [*ssl_cert]             - path to ssl-cert
#   [*ssl_key]              - path to ssl-key
#   [*log_error]            - path to mysql error log
#   [*default_engine]       - configure a default table engine
#   [*root_group]           - use specified group for root-owned files
#   [*restart]              - whether to restart mysqld (true/false)
#   [*character_set]        - You can change the default server and
#     client character set
#   [*key_buffer]           - Index blocks for MyISAM tables are buffered and
#     are shared by all threads. key_buffer_size is the size of the buffer used
#     for index blocks.
#   [*max_allowed_packet]   - The maximum size of one packet or any
#     generated/intermediate string, or any parameter sent by the
#     mysql_stmt_send_long_data() C API function.
#   [*thread_stack]         - The stack size for each thread.
#   [*thread_cache_size]    - How many threads server should cache for reuse.
#   [*myisam-recover]       - Set the MyISAM storage engine recovery mode.
#   [*query_cache_limit]    - Do not cache results that are larger than this
#                             number of bytes.
#   [*query_cache_size]     - The amount of memory allocated for caching query
#                             results.
#   [*max_connections]      - The maximum permitted number of simultaneous
#                             client connections.
#   [*tmp_table_size]       - The maximum size of internal in-memory temporary
#                             tables.
#   [*max_heap_table_size]  - This variable sets the maximum size to which
#     user-created MEMORY tables are permitted to grow.
#   [*table_open_cache]     - The number of open tables for all threads.
#   [*long_query_time]      - If a query takes longer than this many seconds,
#     the server increments the Slow_queries status variable.
#   [*server_id]            - The server ID, used in replication to give each
#     master and slave a unique identity.
#   [*sql_log_bin]          - This variable controls whether logging to the
#     binary log is done. The default value is 1.
#   [*log_bin]              - Enable binary logging. The server logs all
#     statements that change data to the binary log, which is used for backup
#     and replication.
#   [*max_binlog_size]      - If a write to the binary log causes the current
#     log file size to exceed the value of this variable, the server rotates
#     the binary logs (closes the current file and opens the next one).
#   [*binlog_do_db]         - This option affects binary logging in a manner
#     similar to the way that --replicate-do-db affects replication.
#   [*expire_logs_days]     - The number of days for automatic binary log file
#     removal.
#   [*log_bin_trust_function_creators]  - It controls whether stored function
#     creators can be trusted not to create stored functions that will cause
#     unsafe events to be written to the binary log.
#   [*replicate_ignore_table]           - Tells the slave SQL thread not to
#     replicate any statement that updates the specified table, even if any
#     other tables might be updated by the same statement.
#   [*replicate_wild_do_table]          - Tells the slave thread to restrict
#     replication to statements where any of the updated tables match the
#     specified database and table name patterns.
#   [*replicate_wild_ignore_table]      - Tells the slave thread not to
#     replicate a statement where any table matches the given wildcard pattern.
#   [*ft_min_word_len*]     - minimum length of words to be indexed by mysql
#   [*ft_max_word_len*]     - maximum length of words to be indexed by mysql
#
# Actions:
#
# Requires:
#
#   class mysql::server
#
# Usage:
#
#   class { 'mysql::config':
#     root_password => 'changeme',
#     bind_address  => $::ipaddress,
#   }
#
class mysql::config(
  $root_password                    = $mysql::root_password,
  $old_root_password                = $mysql::old_root_password,
  $bind_address                     = $mysql::bind_address,
  $port                             = $mysql::port,
  $etc_root_password                = $mysql::etc_root_password,
  $manage_config_file               = $mysql::manage_config_file,
  $service_name                     = $mysql::service_name,
  $config_file                      = $mysql::config_file,
  $socket                           = $mysql::socket,
  $pidfile                          = $mysql::pidfile,
  $datadir                          = $mysql::datadir,
  $ssl                              = $mysql::ssl,
  $ssl_ca                           = $mysql::ssl_ca,
  $ssl_cert                         = $mysql::ssl_cert,
  $ssl_key                          = $mysql::ssl_key,
  $log_error                        = $mysql::log_error,
  $default_engine                   = $mysql::default_engine,
  $root_group                       = $mysql::root_group,
  $restart                          = $mysql::restart,
  $purge_conf_dir                   = $mysql::purge_conf_dir,
  $key_buffer                       = $mysql::key_buffer,
  $max_allowed_packet               = $mysql::max_allowed_packet,
  $thread_stack                     = $mysql::thread_stack,
  $thread_cache_size                = $mysql::thread_cache_size,
  $myisam_recover                   = $mysql::myisam_recover,
  $query_cache_limit                = $mysql::query_cache_limit,
  $query_cache_size                 = $mysql::query_cache_size,
  $max_binlog_size                  = $mysql::max_binlog_size,
  $expire_logs_days                 = $mysql::expire_logs_days,
  $max_connections                  = $mysql::max_connections,
  $tmp_table_size                   = 'UNSET',
  $max_heap_table_size              = 'UNSET',
  $table_open_cache                 = 'UNSET',
  $long_query_time                  = 'UNSET',
  $character_set                    = 'UNSET',
  $server_id                        = 'UNSET',
  $sql_log_bin                      = 'UNSET',
  $log_bin                          = 'UNSET',
  $binlog_do_db                     = 'UNSET',
  $log_bin_trust_function_creators  = 'UNSET',
  $replicate_ignore_table           = 'UNSET',
  $replicate_wild_do_table          = 'UNSET',
  $replicate_wild_ignore_table      = 'UNSET',
  $ft_min_word_len                  = 'UNSET',
  $ft_max_word_len                  = 'UNSET'
) inherits mysql {

  File {
    owner  => 'root',
    group  => $root_group,
    mode   => '0400',
    notify => $restart ? {
      true  => Exec['mysqld-restart'],
      false => undef,
    },
  }

  if $ssl and $ssl_ca == undef {
    fail('The ssl_ca parameter is required when ssl is true')
  }

  if $ssl and $ssl_cert == undef {
    fail('The ssl_cert parameter is required when ssl is true')
  }

  if $ssl and $ssl_key == undef {
    fail('The ssl_key parameter is required when ssl is true')
  }

  # This kind of sucks, that I have to specify a difference resource for
  # restart.  the reason is that I need the service to be started before mods
  # to the config file which can cause a refresh
  exec { 'mysqld-restart':
    command     => "service ${service_name} restart",
    logoutput   => on_failure,
    refreshonly => true,
    path        => '/sbin/:/usr/sbin/:/usr/bin/:/bin/',
  }

  # manage root password if it is set
  if $root_password != 'UNSET' {
    case $old_root_password {
      '':      { $old_pw='' }
      default: { $old_pw="-p'${old_root_password}'" }
    }

    exec { 'set_mysql_rootpw':
      command   => "mysqladmin -u root ${old_pw} password '${root_password}'",
      logoutput => true,
      unless    => "mysqladmin -u root -p'${root_password}' status > /dev/null",
      path      => '/usr/local/sbin:/usr/bin:/usr/local/bin',
      notify    => $restart ? {
        true  => Exec['mysqld-restart'],
        false => undef,
      },
      require   => File['/etc/mysql/conf.d'],
    }

    file { "${root_home}/.my.cnf":
      content => template('mysql/my.cnf.pass.erb'),
      require => Exec['set_mysql_rootpw'],
      notify  => undef,
    }

    if $etc_root_password {
      file{ '/etc/my.cnf':
        content => template('mysql/my.cnf.pass.erb'),
        require => Exec['set_mysql_rootpw'],
      }
    }
  } else {
    file { "${root_home}/.my.cnf":
      ensure  => present,
    }
  }

  file { '/etc/mysql':
    ensure => directory,
    mode   => '0755',
  }

  file { '/etc/mysql/conf.d':
    ensure  => directory,
    mode    => '0755',
    recurse => $purge_conf_dir,
    purge   => $purge_conf_dir,
  }

  if $manage_config_file  {
    file { $config_file:
      content => template('mysql/my.cnf.erb'),
      mode    => '0644',
    }
  }
}
