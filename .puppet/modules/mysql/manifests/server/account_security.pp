# Some installations have some default users which are not required.
# We remove them here. You can subclass this class to overwrite this behavior.
class mysql::server::account_security {
  database_user {
    [ "root@${::fqdn}",
      'root@127.0.0.1',
      'root@::1',
      "@${::fqdn}",
      '@localhost',
      '@%']:
    ensure  => 'absent',
    require => Class['mysql::config'],
  }
  if ($::fqdn != $::hostname) {
    database_user { ["root@${::hostname}", "@${::hostname}"]:
      ensure  => 'absent',
      require => Class['mysql::config'],
    }
  }
  database { 'test':
    ensure  => 'absent',
    require => Class['mysql::config'],
  }
}
