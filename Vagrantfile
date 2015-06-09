# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
apt-get update
apt-get install -y apache2 git php5-cli php5 libapache2-mod-php5
echo "
<VirtualHost *:80>
    ServerName zf2-tutorial.localhost
    DocumentRoot /var/www/zf/public
    SetEnv APPLICATION_ENV "development"
    <Directory /var/www/zf/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/000-default.conf
a2enmod rewrite
service apache2 restart
cd /var/www/zf
php composer.phar self-update
COMPOSER_VENDOR_DIR=/opt/vendor php composer.phar install
rm -rf /var/www/zf/vendor
ln -s /opt/vendor/ /var/www/zf/vendor
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'chef/ubuntu-14.04'
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder '.', '/var/www/zf'
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "512"]
  end

end
