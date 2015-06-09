# Class: mysql::params
#
#   The mysql configuration settings.
#
# Parameters:
#
# Actions:
#
# Requires:
#
# Sample Usage:
#
class mysql::params {

  $bind_address        = '127.0.0.1'
  $config_template     = 'mysql/my.cnf.erb'
  $default_engine      = 'UNSET'
  $etc_root_password   = false
  $manage_service      = true
  $old_root_password   = ''
  $package_ensure      = 'present'
  $purge_conf_dir      = false
  $max_connections     = 151
  $port                = 3306
  $max_allowed_packet  = '16M'
  $root_password       = 'UNSET'
  $restart             = true
  $ssl                 = false
  $key_buffer          = '16M'
  $thread_stack        = '256K'
  $thread_cache_size   = 8
  $myisam_recover      = 'BACKUP'
  $query_cache_limit   = '1M'
  $query_cache_size    = '16M'
  $expire_logs_days    = 10
  $max_binlog_size     = '100M'

  case $::operatingsystem {
    'Ubuntu': {
      $service_provider = upstart
    }
    default: {
      $service_provider = undef
    }
  }

  case $::osfamily {
    'RedHat': {
      if $::operatingsystem == 'Fedora' and $::operatingsystemrelease >= 19 {
        $client_package_name = 'mariadb'
        $server_package_name = 'mariadb-server'
      } else {
        $client_package_name = 'mysql'
        $server_package_name = 'mysql-server'
      }
      $basedir               = '/usr'
      $config_file           = '/etc/my.cnf'
      $datadir               = '/var/lib/mysql'
      $tmpdir                = '/tmp'
      $java_package_name     = 'mysql-connector-java'
      $log_error             = '/var/log/mysqld.log'
      $perl_package_name     = 'perl-DBD-MySQL'
      $php_package_name      = 'php-mysql'
      $pidfile               = '/var/run/mysqld/mysqld.pid'
      $python_package_name   = 'MySQL-python'
      $root_group            = 'root'
      $ruby_package_name     = 'ruby-mysql'
      $ruby_package_provider = 'gem'
      $service_name          = 'mysqld'
      $socket                = '/var/lib/mysql/mysql.sock'
      $ssl_ca                = '/etc/mysql/cacert.pem'
      $ssl_cert              = '/etc/mysql/server-cert.pem'
      $ssl_key               = '/etc/mysql/server-key.pem'
    }

    'Suse': {
      $basedir               = '/usr'
      $datadir               = '/var/lib/mysql'
      $tmpdir                = '/tmp'
      $service_name          = 'mysql'
      $client_package_name   = $::operatingsystem ? {
        /OpenSuSE/           => 'mysql-community-server-client',
        /(SLES|SLED)/        => 'mysql-client',
        }
      $server_package_name   = $::operatingsystem ? {
        /OpenSuSE/           => 'mysql-community-server',
        /(SLES|SLED)/        => 'mysql',
        }
      $socket                = $::operatingsystem ? {
        /OpenSuSE/           => '/var/run/mysql/mysql.sock',
        /(SLES|SLED)/        => '/var/lib/mysql/mysql.sock',
        }
      $pidfile               = $::operatingsystem ? {
        /OpenSuSE/           => '/var/run/mysql/mysqld.pid',
        /(SLES|SLED)/        => '/var/lib/mysql/mysqld.pid',
        }
      $config_file           = '/etc/my.cnf'
      $log_error             = $::operatingsystem ? {
        /OpenSuSE/           => '/var/log/mysql/mysqld.log',
        /(SLES|SLED)/        => '/var/log/mysqld.log',
        }
      $ruby_package_name     = $::operatingsystem ? {
        /OpenSuSE/           => 'rubygem-mysql',
        /(SLES|SLED)/        => 'ruby-mysql',
        }
      $python_package_name   = 'python-mysql'
      $perl_package_name     = 'perl-DBD-mysql'
      $java_package_name     = 'mysql-connector-java'
      $root_group            = 'root'
      $ssl_ca                = '/etc/mysql/cacert.pem'
      $ssl_cert              = '/etc/mysql/server-cert.pem'
      $ssl_key               = '/etc/mysql/server-key.pem'
    }

    'Debian': {
      $basedir              = '/usr'
      $datadir              = '/var/lib/mysql'
      $tmpdir                = '/tmp'
      $service_name         = 'mysql'
      $client_package_name  = 'mysql-client'
      $server_package_name  = 'mysql-server'
      $socket               = '/var/run/mysqld/mysqld.sock'
      $pidfile              = '/var/run/mysqld/mysqld.pid'
      $config_file          = '/etc/mysql/my.cnf'
      $log_error            = '/var/log/mysql/error.log'
      $perl_package_name    = 'libdbd-mysql-perl'
      $ruby_package_name    = 'libmysql-ruby'
      $python_package_name  = 'python-mysqldb'
      $php_package_name     = 'php5-mysql'
      $java_package_name    = 'libmysql-java'
      $root_group           = 'root'
      $ssl_ca               = '/etc/mysql/cacert.pem'
      $ssl_cert             = '/etc/mysql/server-cert.pem'
      $ssl_key              = '/etc/mysql/server-key.pem'
    }

    'FreeBSD': {
      $basedir               = '/usr/local'
      $datadir               = '/var/db/mysql'
      $tmpdir                = '/tmp'
      $service_name          = 'mysql-server'
      $client_package_name   = 'databases/mysql55-client'
      $server_package_name   = 'databases/mysql55-server'
      $socket                = '/tmp/mysql.sock'
      $pidfile               = '/var/db/mysql/mysql.pid'
      $config_file           = '/var/db/mysql/my.cnf'
      $log_error             = "/var/db/mysql/${::hostname}.err"
      $perl_package_name     = 'p5-DBD-mysql'
      $ruby_package_name     = 'ruby-mysql'
      $ruby_package_provider = 'gem'
      $python_package_name   = 'databases/py-MySQLdb'
      $php_package_name      = 'php5-mysql'
      $java_package_name     = 'databases/mysql-connector-java'
      $root_group            = 'wheel'
      $ssl_ca                = undef
      $ssl_cert              = undef
      $ssl_key               = undef
    }

    default: {
      case $::operatingsystem {
        'Amazon': {
          $basedir               = '/usr'
          $datadir               = '/var/lib/mysql'
          $tmpdir                = '/tmp'
          $service_name          = 'mysqld'
          $client_package_name   = 'mysql'
          $server_package_name   = 'mysql-server'
          $socket                = '/var/lib/mysql/mysql.sock'
          $config_file           = '/etc/my.cnf'
          $log_error             = '/var/log/mysqld.log'
          # XXX validate...
          $perl_package_name     = 'perl-DBD-MySQL'
          $ruby_package_name     = 'ruby-mysql'
          $ruby_package_provider = 'gem'
          $python_package_name   = 'MySQL-python'
          $php_package_name      = 'php-mysql'
          $java_package_name     = 'mysql-connector-java'
          $root_group            = 'root'
          $ssl_ca                = '/etc/mysql/cacert.pem'
          $ssl_cert              = '/etc/mysql/server-cert.pem'
          $ssl_key               = '/etc/mysql/server-key.pem'
        }

        default: {
          fail("Unsupported osfamily: ${::osfamily} operatingsystem: ${::operatingsystem}, module ${module_name} only support osfamily RedHat, Debian, and FreeBSD, or operatingsystem Amazon")
        }
      }
    }
  }

}
