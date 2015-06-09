# Class: mysql
#
#   This class installs mysql client software.
#
# Parameters:
#
# [*basedir*]               - The base directory mysql uses
#
# [*bind_address*]          - The IP mysql binds to.
#
# [*client_package_name*]   - The name of the mysql client package.
#
# [*config_file*]           - The location of the server config file
#
# [*config_template*]       - The template to use to generate my.cnf.
#
# [*datadir*]               - The directory MySQL's datafiles are stored
#
# [*tmpdir*]                - The directory MySQL's tmpfiles are stored
#
# [*default_engine*]        - The default engine to use for tables
#
# [*etc_root_password*]     - Whether or not to add the mysql root password to /etc/my.cnf
#
# [*java_package_name*]     - The name of the java package containing the java connector
#
# [*log_error*]             - Where to log errors
#
# [*manage_config_file*]    - if the config file should be managed (default: true)
#
# [*manage_service*]        - Boolean dictating if mysql::server should manage the service
#
# [*max_allowed_packet*]    - Maximum network packet size mysqld will accept
#
# [*old_root_password*]     - Previous root user password,
#
# [*package_ensure*]        - ensure value for packages.
#
# [*package_name*]          - legacy parameter used to specify the client package. Should not be used going forward
#
# [*perl_package_name*]     - The name of the perl mysql package to install
#
# [*perl_package_provider*] - The installation suite to use when installing the perl package.
#
# [*php_package_name*]      - The name of the phpmysql package to install
#
# [*pidfile*]               - The location mysql will expect the pidfile to be, and will put it when starting the service.
#
# [*port*]                  - The port mysql listens on
#
# [*purge_conf_dir*]        - Value fed to recurse and purge parameters of the /etc/mysql/conf.d resource
#
# [*python_package_name*]   - The name of the python mysql package to install
#
# [*restart*]               - Whether to restart mysqld (true/false)
#
# [*root_group*]            - Use specified group for root-owned files
#
# [*root_password*]         - The root MySQL password to use
#
# [*ruby_package_name*]     - The name of the ruby mysql package to install
#
# [*ruby_package_provider*] - The installation suite to use when installing the ruby package.
#                             FreeBSD Does not use this.
#
# [*server_package_ensure*] - ensure value for server packages.
#
# [*server_package_name*]   - The name of the server package to install
#
# [*service_provider*]      - Sets the service provider to upstart on Ubuntu systems for mysql::server.
#
# [*service_name*]          - The name of the service to start
#
# [*socket*]                - The location of the MySQL server socket file
#
# [*ssl*]                   - Whether or not to enable ssl
#
# [*ssl_ca*]                - The location of the SSL CA Cert
#
# [*ssl_cert*]              - The location of the SSL Certificate to use
#
# [*ssl_key*]               - The SSL key to use
#
# Actions:
#
# Requires:
#
# Sample Usage:
#
class mysql(
  $basedir               = $mysql::params::basedir,
  $bind_address          = $mysql::params::bind_address,
  $client_package_name   = $mysql::params::client_package_name,
  $config_file           = $mysql::params::config_file,
  $config_template       = $mysql::params::config_template,
  $datadir               = $mysql::params::datadir,
  $tmpdir                = $mysql::params::tmpdir,
  $default_engine        = $mysql::params::default_engine,
  $etc_root_password     = $mysql::params::etc_root_password,
  $java_package_name     = $mysql::params::java_package_name,
  $log_error             = $mysql::params::log_error,
  $manage_config_file    = true,
  $manage_service        = $mysql::params::manage_service,
  $max_allowed_packet    = $mysql::params::max_allowed_packet,
  $old_root_password     = $mysql::params::old_root_password,
  $package_ensure        = $mysql::params::package_ensure,
  $package_name          = undef,
  $perl_package_name     = $mysql::params::perl_package_name,
  $perl_package_provider = $mysql::params::perl_package_provider,
  $php_package_name      = $mysql::params::php_package_name,
  $pidfile               = $mysql::params::pidfile,
  $port                  = $mysql::params::port,
  $purge_conf_dir        = $mysql::params::purge_conf_dir,
  $python_package_name   = $mysql::params::python_package_name,
  $max_connections       = $mysql::params::max_connections,
  $restart               = $mysql::params::restart,
  $root_group            = $mysql::params::root_group,
  $root_password         = $mysql::params::root_password,
  $ruby_package_name     = $mysql::params::ruby_package_name,
  $ruby_package_provider = $mysql::params::ruby_package_provider,
  $server_package_name   = $mysql::params::server_package_name,
  $service_name          = $mysql::params::service_name,
  $service_provider      = $mysql::params::service_provider,
  $socket                = $mysql::params::socket,
  $ssl                   = $mysql::params::ssl,
  $ssl_ca                = $mysql::params::ssl_ca,
  $ssl_cert              = $mysql::params::ssl_cert,
  $ssl_key               = $mysql::params::ssl_key
) inherits mysql::params{
  if $package_name {
    warning('Using $package_name has been deprecated in favor of $client_package_name and will be removed.')
    $client_package_name_real = $package_name
  } else {
    $client_package_name_real = $client_package_name
  }
  package { 'mysql_client':
    ensure => $package_ensure,
    name   => $client_package_name_real,
  }

  Class['mysql::config'] -> Mysql::Db <| |>

}
