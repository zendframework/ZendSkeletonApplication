# defined type puphpet::ini
#
# Writes custom ini files. This generation
# is independent from any other resource, so you have to
# notify the needed resources on your own.
#
# Example:
# puphpet::ini { 'custom_php':
#  value   => ['date.timezone = "America/Chicago"'],
#  ini     => '/etc/php5/cgi/conf.d/custom_php.ini',
#  notify  => Service['apache'],
# }
#
define puphpet::ini (
    $value    = '',
    $ini      = undef,
    $template = 'extra-ini.erb'
) {

  if $ini {
      file { $ini:
        ensure  => present,
        content => template("puphpet/${template}"),
      }
  }

}
