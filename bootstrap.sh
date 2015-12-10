#!/usr/bin/env bash

apt-get update
apt-get install -y curl python-software-properties apache2 pdftk
add-apt-repository -y ppa:ondrej/php-7.0
apt-get update
apt-get install -y php7.0
rm -rf /var/www/html
ln -fs /vagrant/public /var/www/html
a2enmod rewrite
sed -i "s/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\n\n\t<Directory \/var\/www\/html>\n\t\tAllowOverride All\n\t<\/Directory>\n/" /etc/apache2/sites-available/000-default.conf
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
curl -O http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb
dpkg -i --force-depends *.deb
apt-get install -fy
service apache2 restart
