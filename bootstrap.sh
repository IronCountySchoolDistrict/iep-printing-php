#!/usr/bin/env bash

PASSWORD='secret'

apt-get update
apt-get install -y curl python-software-properties apache2 pdftk alien libaio1
add-apt-repository -y ppa:ondrej/php
apt-get update
apt-get install -y php7.0 php7.0-dev

sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server
sudo apt-get install php7.0-mysql

mysql -uroot p$PASSWORD -e "create database 'iep' character set utf8 collate utf8_unicode_ci;"

rm -rf /var/www/html
ln -fs /vagrant/public /var/www/html
a2enmod rewrite
sed -i "s/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\n\n\t<Directory \/var\/www\/html>\n\t\tAllowOverride All\n\t<\/Directory>\n/" /etc/apache2/sites-available/000-default.conf
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
curl -O http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb
dpkg -i --force-depends *.deb
apt-get install -fy

alien -i /vagrant/_server/oracle-instantclient12.1-basic-12.1.0.2.0-1.x86_64.rpm
alien -i /vagrant/_server/oracle-instantclient12.1-devel-12.1.0.2.0-1.x86_64.rpm
printf "\n" | pecl install oci8
sed -i "/Use with Oracle Database 12c Instant Client/aextension=oci8.so" /etc/php/7.0/apache2/php.ini

service apache2 restart
