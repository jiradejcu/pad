#!/bin/sh
yum install httpd
systemctl start httpd.service
systemctl enable httpd.service

yum install mariadb-server mariadb
systemctl start mariadb
mysql_secure_installation
systemctl enable mariadb.service

yum install php php-mysql
systemctl restart httpd.service
yum install php-fpm

yum install php-cli php-zip wget unzip
cd ~ && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
composer

yum update
yum remove php-cli mod_php php-common
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum install php70w php70w-fpm php70w-mbstring php70w-mcrypt php70w-mysql php70w-xml
sudo apachectl restart

chmod -R 777 storage/
composer install

sudo nano /etc/httpd/conf/httpd.conf
# <Directory /var/www/html>
#     AllowOverride All
# </Directory>
sudo systemctl restart httpd

sudo yum install phpmyadmin
# edit /etc/httpd/conf.d/phpMyAdmin.conf as follows

#Alias /phpMyAdmin /usr/share/phpMyAdmin
#Alias /phpmyadmin /usr/share/phpMyAdmin
#
#<Directory /usr/share/phpMyAdmin/>
#   AddDefaultCharset UTF-8
#
#   <IfModule mod_authz_core.c>
#     # Apache 2.4
#     Require all granted
#   </IfModule>
#   <IfModule !mod_authz_core.c>
#     # Apache 2.2
#     Order Allow, Deny
#     Allow from All
#     Allow from 127.0.0.1
#     Allow from ::1
#   </IfModule>
#</Directory>

sudo systemctl restart httpd

cp .env.dist .env
# edit database config

php artisan migrate
php artisan db:seed
