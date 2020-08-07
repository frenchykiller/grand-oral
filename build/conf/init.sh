#!/bin/bash

ip route|awk '/default/ { print $3" host.docker.internal"}' >> /etc/hosts

cp /var/www/conf/php/${PHP_CONFIG}/php.ini /etc/php/${PHP_VERSION}/apache2/conf.d/app.ini

rm /etc/php/${PHP_VERSION}/apache2/conf.d/*-xdebug.ini
if [ -f /var/www/conf/php/${PHP_CONFIG}/xdebug.ini ] && [ "${PHP_XDEBUG}" = "true" ] && [ "${XDEBUG}" = "true" ]; then
  cp /var/www/conf/php/${PHP_CONFIG}/xdebug.ini /etc/php/${PHP_VERSION}/apache2/conf.d/20-xdebug.ini
fi

# User & Group
usermod -u ${UID} www-data
groupmod -g ${UID} www-data

# Start apache
rm -f /var/run/apache2/apache2.pid
source /etc/apache2/envvars
exec apache2 -DFOREGROUND
