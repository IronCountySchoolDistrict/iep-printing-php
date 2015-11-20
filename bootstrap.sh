#!/usr/bin/env bash

echo "--- Updating packages List ---"
apt-get update

echo "--- Installing MySQL ---"
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo "--- Installing base packages ---"
apt-get install -y vim curl python-software-properties

echo "--- Updating packages List ---"
apt-get update

echo "--- get the latest version of PHP ---"
add-apt-repository -y ppa:ondrej/php5-5.6

echo "--- installing bulk of packages ---"
apt-get install -y git apache2 mysql-server php5-mysql php5 libapache2-mod-php5 php5-mcrypt pdftk

echo "--- enable mod-rewrite for apache ---"
a2enmod rewrite

echo "--- Setting document root to public directory. ---"
rm -rf /var/www/html
ln -fs /vagrant/public /var/www/html

echo "--- alter some files ---"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors - .*/display_errors = On/" /etc/php5/apache2/php.ini
sed -i "s/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\n\n\t<Directory \/var\/www\/html>\n\t\tAllowOverride All\n\t<\/Directory>\n/" /etc/apache2/sites-available/000-default.conf

echo "--- restart apache ---"
service apache2 restart

echo "--- get composer ---"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

echo "--- install wkhtmltopdf ---"
wget http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb
dpkg -i --force-depends *.deb
apt-get install -fy
