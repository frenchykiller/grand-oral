FROM bitnami/minideb:stretch
ARG DEBIAN_FRONTEND=noninteractive
ARG UID=1000
ARG PHP_CONFIG=dev

RUN apt-get update && install_packages \
    apt-transport-https \
    apt-utils \
    ca-certificates \
    make \
    wget \
    curl \
    locales \
    git \
    zip \
    unzip \
    apache2 \
    ssmtp \
    gawk \
    iputils-ping \
    vim \
    cron \
    supervisor \
    iproute

# Timezone & Locales
RUN ln -sf /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN echo "fr_FR.UTF-8 UTF-8" > /etc/locale.gen && locale-gen fr_FR.UTF-8
RUN dpkg-reconfigure locales
RUN /usr/sbin/update-locale LANG=fr_FR.UTF-8

# Script for version control
ADD conf/version /usr/bin/version
RUN chmod +x /usr/bin/version

# Image optimizers
ARG INSTALL_IMAGE_OPTIMIZERS=false
RUN if [ ${INSTALL_IMAGE_OPTIMIZERS} = true ]; then \
    install_packages jpegoptim optipng pngquant gifsicle \
;fi

# PHP
ARG PHP_VERSION=7.2
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list
RUN install_packages libapache2-mod-php${PHP_VERSION} php${PHP_VERSION} php${PHP_VERSION}-cli

# Packages PHP
ARG PHP_APC=false
RUN if [ ${PHP_APC} = true ]; then install_packages php${PHP_VERSION}-apc ;fi

ARG PHP_BCMATH=false
RUN if [ ${PHP_BCMATH} = true ]; then install_packages php${PHP_VERSION}-bcmath ;fi

ARG PHP_CALENDAR=false
RUN if [ ${PHP_CALENDAR} = true ]; then install_packages php${PHP_VERSION}-calendar ;fi

ARG PHP_CURL=false
RUN if [ ${PHP_CURL} = true ]; then install_packages php${PHP_VERSION}-curl ;fi

ARG PHP_DOM=false
RUN if [ ${PHP_DOM} = true ]; then install_packages php${PHP_VERSION}-dom ;fi

ARG PHP_EXIF=false
RUN if [ ${PHP_EXIF} = true ]; then install_packages php${PHP_VERSION}-exif ;fi

ARG PHP_FILEINFO=false
RUN if [ ${PHP_FILEINFO} = true ]; then install_packages php${PHP_VERSION}-fileinfo ;fi

ARG PHP_GD=false
RUN if [ ${PHP_GD} = true ]; then install_packages php${PHP_VERSION}-gd ;fi

ARG PHP_GMP=false
RUN if [ ${PHP_GMP} = true ]; then install_packages php${PHP_VERSION}-gmp ;fi

ARG PHP_IMAGICK=false
RUN if [ ${PHP_IMAGICK} = true ]; then install_packages php${PHP_VERSION}-imagick ;fi

ARG PHP_IMAP=false
RUN if [ ${PHP_IMAP} = true ]; then install_packages php${PHP_VERSION}-imap ;fi

ARG PHP_INTL=false
RUN if [ ${PHP_INTL} = true ]; then install_packages php${PHP_VERSION}-intl ;fi

ARG PHP_JSON=false
RUN if [ ${PHP_JSON} = true ]; then install_packages php${PHP_VERSION}-json ;fi

ARG PHP_LDAP=false
RUN if [ ${PHP_LDAP} = true ]; then install_packages php${PHP_VERSION}-ldap ;fi

ARG PHP_MBSTRING=false
RUN if [ ${PHP_MBSTRING} = true ]; then install_packages php${PHP_VERSION}-mbstring ;fi

ARG PHP_MCRYPT=false
RUN if [ ${PHP_MCRYPT} = true ]; then \
        if [ $(version ${PHP_VERSION}) -lt $(version 7.2) ]; then \
            install_packages php${PHP_VERSION}-mcrypt ; \
        else \
            echo "No mcrypt package for PHP >= 7.2" \
        ; fi \
    ;fi

ARG PHP_MEMCACHED=false
RUN if [ ${PHP_MEMCACHED} = true ]; then install_packages php${PHP_VERSION}-memcached ;fi

ARG PHP_MYSQL=false
RUN if [ ${PHP_MYSQL} = true ]; then install_packages php${PHP_VERSION}-mysql ;fi

ARG PHP_MONGO=false
RUN if [ ${PHP_MONGO} = true ]; then install_packages php${PHP_VERSION}-mongo ;fi

ARG PHP_OPCACHE=false
RUN if [ ${PHP_OPCACHE} = true ]; then install_packages php${PHP_VERSION}-opcache ;fi

ARG PHP_ODBC=false
RUN if [ ${PHP_ODBC} = true ]; then install_packages php${PHP_VERSION}-odbc ;fi

ARG PHP_PGSQL=false
RUN if [ ${PHP_PGSQL} = true ]; then install_packages php${PHP_VERSION}-pgsql ;fi

ARG PHP_REDIS=false
RUN if [ ${PHP_REDIS} = true ]; then install_packages php${PHP_VERSION}-redis ;fi

ARG PHP_SOAP=false
RUN if [ ${PHP_SOAP} = true ]; then install_packages php${PHP_VERSION}-soap ;fi

ARG PHP_SQLITE3=false
RUN if [ ${PHP_SQLITE3} = true ]; then install_packages php${PHP_VERSION}-sqlite3 ;fi

ARG PHP_XDEBUG=false
RUN if [ ${PHP_XDEBUG} = true ]; then install_packages php${PHP_VERSION}-xdebug ;fi

ARG PHP_XML=false
RUN if [ ${PHP_XML} = true ]; then install_packages php${PHP_VERSION}-xml ;fi

ARG PHP_XMLRPC=false
RUN if [ ${PHP_XMLRPC} = true ]; then install_packages php${PHP_VERSION}-xmlrpc ;fi

ARG PHP_ZIP=false
RUN if [ ${PHP_ZIP} = true ]; then install_packages php${PHP_VERSION}-zip ;fi

ARG PHP_ZMQ=false
RUN if [ ${PHP_ZMQ} = true ]; then install_packages php${PHP_VERSION}-zmq ;fi

# PHP configuration
ADD conf/${PHP_CONFIG}/php.ini /etc/php/${PHP_VERSION}/apache2/conf.d
COPY conf/${PHP_CONFIG}/php-cli.ini /etc/php/${PHP_VERSION}/cli/conf.d/php.ini

# Composer
ARG INSTALL_COMPOSER=false
RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
;fi

# NodeJs
ARG NODE_VERSION=10
ARG INSTALL_NODE=false
RUN if [ ${INSTALL_NODE} = true ]; then \
    install_packages gnupg lsb-release libpng-dev gcc g++ libc-dev \
    && curl -sL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && install_packages nodejs \
;fi

# SSMTP
ADD conf/ssmtp.conf /etc/ssmtp/ssmtp.conf

# Apache configuration
RUN a2enmod rewrite headers expires remoteip
RUN a2disconf other-vhosts-access-log
ADD conf/apache2.conf /etc/apache2/conf-enabled/app.conf
ADD conf/remoteip.conf /etc/apache2/conf-enabled/remoteip.conf
ADD conf/vhost.conf /etc/apache2/sites-enabled/000-default.conf
ADD conf/prepend.php /var/www/prepend.php

# User & Group
RUN usermod -u ${UID} www-data
RUN groupmod -g ${UID} www-data

# Alias & git
ADD conf/bashrc /root/.bashrc
ADD conf/git_config /root/.gitconfig
ADD conf/bashrc /var/www/.bashrc
ADD conf/git_config /var/www/.gitconfig

# Workdir
RUN mkdir -p /var/www/app
RUN chown -R www-data:www-data /var/www

# Healthcheck
HEALTHCHECK CMD curl --fail http://localhost:80 || exit 1

# Default workdir
WORKDIR /var/www/app

# Init script
COPY conf/init.sh /usr/bin/init
RUN chmod 0755 /usr/bin/init

# Crontab
ADD conf/crontab /etc/cron.d/crontab

EXPOSE 80

# Supervisor
COPY conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
