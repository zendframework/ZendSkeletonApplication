FROM ubuntu:14.04
MAINTAINER Zend Framework
ENV PROJECT_PATH /var/www/zf-skeleton
ENV PROJECT_URL localhost
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update

# Apache2 and PHP5
RUN apt-get -y --force-yes install git curl apache2 php5 libapache2-mod-php5

# Apache2 mods
RUN a2enmod php5
RUN a2enmod rewrite

# Apache2 environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Apache2 conf
RUN echo "ServerName localhost" | sudo tee /etc/apache2/conf-available/fqdn.conf
RUN a2enconf fqdn

# Port to expose
EXPOSE 80

# VirtualHost
RUN echo "\
<VirtualHost *:80>\n\
  ServerName $PROJECT_URL\n\
  DocumentRoot $PROJECT_PATH/public\n\
  <Directory $PROJECT_PATH/>\n\
    DirectoryIndex index.php\n\
    Options Indexes FollowSymLinks MultiViews\n\
    AllowOverride All\n\
    Order deny,allow\n\
    Allow from all\n\
  </Directory>\n\
</VirtualHost>\n\
" > /etc/apache2/sites-available/zf-skeleton.conf
RUN a2dissite 000-default
RUN a2ensite zf-skeleton

# Copy site into place
ADD . $PROJECT_PATH

# Composer
RUN cd $PROJECT_PATH && curl -Ss https://getcomposer.org/installer | php && php composer.phar install --no-progress