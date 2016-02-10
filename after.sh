#!/usr/bin/env bash

apt-get install -y alien pdftk

curl -O http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb
dpkg -i --force-depends *.deb
apt-get install -fy

alien -i /vagrant/_server/oracle-instantclient12.1-basic-12.1.0.2.0-1.x86_64.rpm
alien -i /vagrant/_server/oracle-instantclient12.1-devel-12.1.0.2.0-1.x86_64.rpm
printf "\n" | pecl install oci8
sed -i "/Use with Oracle Database 12c Instant Client/aextension=oci8.so" /etc/php/7.0/fpm/php.ini

service php7.0-fpm restart
