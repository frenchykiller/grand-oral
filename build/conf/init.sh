#!/bin/bash

ip route|awk '/default/ { print $3" host.docker.internal"}' >> /etc/hosts

cp /var/www/conf/php/${PHP_CONFIG}/php.ini /etc/php/${PHP_VERSION}/apache2/conf.d/app.ini

# User & Group
usermod -u ${UID} www-data
groupmod -g ${UID} www-data

# Start apache
rm -f /var/run/apache2/apache2.pid
source /etc/apache2/envvars
exec apache2 -DFOREGROUND
