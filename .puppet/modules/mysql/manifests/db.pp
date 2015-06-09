# Define: mysql::db
#
# This module creates database instances, a user, and grants that user
# privileges to the database.  It can also import SQL from a file in order to,
# for example, initialize a database schema.
#
# Since it requires class mysql::server, we assume to run all commands as the
# root mysql user against the local mysql server.
#
# Parameters:
#   [*title*]       - mysql database name.
#   [*user*]        - username to create and grant access.
#   [*password*]    - user's password.
#   [*charset*]     - database charset.
#   [*host*]        - host for assigning privileges to user.
#   [*grant*]       - array of privileges to grant user.
#   [*enforce_sql*] - whether to enforce or conditionally run sql on creation.
#   [*sql*]         - sql statement to run.
#   [*ensure*]      - specifies if a database is present or absent.
#
# Actions:
#
# Requires:
#
#   class mysql::server
#
# Sample Usage:
#
#  mysql::db { 'mydb':
#    user     => 'my_user',
#    password => 'password',
#    host     => $::hostname,
#    grant    => ['all']
#  }
#
define mysql::db (
  $user,
  $password,
  $charset     = 'utf8',
  $host        = 'localhost',
  $grant       = 'all',
  $sql         = '',
  $enforce_sql = false,
  $ensure      = 'present'
) {

  validate_re($ensure, '^(present|absent)$',
  "${ensure} is not supported for ensure. Allowed values are 'present' and 'absent'.")

  database { $name:
    ensure   => $ensure,
    charset  => $charset,
    provider => 'mysql',
    require  => Class['mysql::server'],
    before   => Database_user["${user}@${host}"],
  }

  $user_resource = {
    ensure        => $ensure,
    password_hash => mysql_password($password),
    provider      => 'mysql'
  }
  ensure_resource('database_user', "${user}@${host}", $user_resource)

  if $ensure == 'present' {
    database_grant { "${user}@${host}/${name}":
      privileges => $grant,
      provider   => 'mysql',
      require    => Database_user["${user}@${host}"],
    }

    $refresh = ! $enforce_sql

    if $sql {
      exec{ "${name}-import":
        command     => "/usr/bin/mysql ${name} < ${sql}",
        logoutput   => true,
        refreshonly => $refresh,
        require     => Database_grant["${user}@${host}/${name}"],
        subscribe   => Database[$name],
      }
    }
  }
}
