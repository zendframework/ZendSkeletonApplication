include apache

apache::vhost { 'testsite':
  docroot       => '/var/www/test',
  env_variables => ['APP_ENV dev'],
}

