# Creates a my.cnf like config file in the conf.d/ directory.
#
# IMPORTANT: this should be used AFTER the inclusion of
#            mysql::server because it needs some variables
#            out of the mysql::config class which will be
#            included!
#
# == Parameters:
#
# - name: is the name of the file
# - notify_service: whether to notify the mysql daemon or not (default: true)
# - settings: either a string which should be the content of the file
#     or a hash with the following structure
#
#     section => {
#       <key> => <value>,
#       ...
#     },
#     ...
#
#   +section+ means all these sections you can set in
#             an configuration file like +mysqld+, +client+,
#             +mysqldump+ and so on
#   +key+ has to be a valid property which you can set like
#         +datadir+, +socket+ or even flags like +read-only+
#
#   +value+ can be
#     a) a string as the value
#     b) +true+ or +false+ to set a flag like 'read-only' or leave
#        it out (+false+ means, nothing will be done)
#     c) an array of values which can be of type a) and/or b)
#
#
# == Examples:
#
#   Easy one:
#
#   mysql::server::config { 'basic_config':
#     settings => "[mysqld]\nskip-external-locking\n"
#   }
#
#   This will create the file /etc/mysql/conf.d/basic_config.cnf with
#   the following content:
#
#   [mysqld]
#   skip-external-locking
#
#
#   More complex example:
#
#   mysql::server::config { 'basic_config':
#     settings => {
#       'mysqld' => {
#         'query_cache_limit'     => '5M',
#         'query_cache_size'      => '128M',
#         'port'                  => 3300,
#         'skip-external-locking' => true,
#         'replicate-ignore-db'   => [
#           'tmp_table',
#           'whateveryouwant'
#         ]
#       },
#
#       'client' => {
#         'port' => 3300
#       }
#     }
#   }
#
#   This will create the file /etc/mysql/conf.d/basic_config.cnf with
#   the following content:
#
#   [mysqld]
#   query_cache_limit = 5M
#   query_cache_size = 128M
#   port = 3300
#   skip-external-locking
#   replicate-ignore-db = tmp_table
#   replicate-ignore-db = whateveryouwant
#
#   [client]
#   port = 3300
#
define mysql::server::config (
  $settings,
  $notify_service = true
) {
  include mysql::config

  if is_hash($settings) {
    $content = template('mysql/my.conf.cnf.erb')
  } else {
    $content = $settings
  }

  file { "/etc/mysql/conf.d/${name}.cnf":
    ensure  => file,
    content => $content,
    owner   => 'root',
    group   => $mysql::config::root_group,
    mode    => '0644',
    require => Package['mysql-server'],
  }

  if $notify_service {
    File["/etc/mysql/conf.d/${name}.cnf"] {
      # XXX notifying the Service gives us a dependency circle but I don't understand why
      notify => Exec['mysqld-restart']
    }
  }
}
