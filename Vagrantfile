# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
add-apt-repository ppa:ondrej/php
apt-get update
apt-get install -y apache2 git curl php7.0 php7.0-bcmath php7.0-bz2 php7.0-cli php7.0-curl php7.0-intl php7.0-json php7.0-mbstring php7.0-opcache php7.0-soap php7.0-sqlite3 php7.0-xml php7.0-xsl php7.0-zip libapache2-mod-php7.0
sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf
a2enmod rewrite
service apache2 restart
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
if ! grep "cd /var/www" /home/vagrant/.profile > /dev/null; then
    echo "cd /var/www" >> /home/vagrant/.profile
fi
echo "** [ZF] Run the following command to install dependencies, if you have not already:"
echo "    vagrant ssh -c 'composer install'"
echo "** [ZF] Visit http://localhost:8080 in your browser for to view the application **"
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'ubuntu/trusty64'
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.synced_folder '.', '/var/www'
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
