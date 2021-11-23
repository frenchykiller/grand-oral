FROM debian:buster-slim
ENV DEBIAN_FRONTEND=noninteractive

COPY conf/install_packages /usr/sbin/install_packages
RUN chmod +x /usr/sbin/install_packages

RUN install_packages \
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
    msmtp \
    msmtp-mta \
    gawk \
    iputils-ping \
    vim \
    cron \
    iproute2 \
    python-pip \
    python-setuptools

# Supervisord
RUN pip install supervisor
RUN pip install supervisor-stdout

# Timezone & Locales
ARG LOCALE=fr_FR.UTF-8
RUN ln -sf /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN echo "${LOCALE} UTF-8" > /etc/locale.gen && locale-gen && dpkg-reconfigure --frontend=noninteractive locales && update-locale LANG=${LOCALE}
ENV LANG ${LOCALE}

# Script for version control
ADD conf/version /usr/bin/version
RUN chmod +x /usr/bin/version

# PHP
ARG PHP_VERSION=7.4
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ buster main" > /etc/apt/sources.list.d/php.list
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
RUN if [ $(version ${PHP_VERSION}) -lt $(version 8.0) ]; then \
        if [ ${PHP_JSON} = true ]; then install_packages php${PHP_VERSION}-json ;fi \
    ;fi

ARG PHP_LDAP=false
RUN if [ ${PHP_LDAP} = true ]; then install_packages php${PHP_VERSION}-ldap ;fi

ARG PHP_MBSTRING=false
RUN if [ ${PHP_MBSTRING} = true ]; then install_packages php${PHP_VERSION}-mbstring ;fi

ARG PHP_MCRYPT=false
RUN if [ ${PHP_MCRYPT} = true ]; then install_packages php${PHP_VERSION}-mcrypt ;fi

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
ENV PHP_XDEBUG=${PHP_XDEBUG}
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
COPY conf/php-cli.ini /etc/php/${PHP_VERSION}/cli/conf.d/php.ini

# Composer
ARG INSTALL_COMPOSER=false
RUN if [ ${INSTALL_COMPOSER} = true ]; then \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
;fi

# NodeJs
ARG NODE_VERSION=14
ARG INSTALL_NODE=false
RUN if [ ${INSTALL_NODE} = true ]; then \
    curl -sL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && install_packages nodejs \
;fi

# Image optimizers
ARG INSTALL_IMAGE_OPTIMIZERS=false
RUN if [ ${INSTALL_IMAGE_OPTIMIZERS} = true ]; then \
    install_packages jpegoptim optipng pngquant gifsicle \
;fi

# Cleanup
RUN apt-get -y --purge --autoremove remove python3.7
RUN rm -rf /var/lib/apt/lists/* \
    /var/cache/apt/archives/* \
    /usr/share/doc/* \
    /var/lib/dpkg/info/*.md5sums

# MSMTP
ADD conf/msmtprc /etc/msmtprc

# Apache configuration
RUN a2enmod rewrite headers expires remoteip proxy_http proxy_wstunnel
RUN a2disconf other-vhosts-access-log
ADD conf/apache2.conf /etc/apache2/conf-enabled/app.conf
ADD conf/remoteip.conf /etc/apache2/conf-enabled/remoteip.conf
ADD conf/vhost.conf /etc/apache2/sites-enabled/000-default.conf
ADD conf/prepend.php /var/www/prepend.php

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

# Dockergen (build hosts)
ENV DOCKER_GEN_VERSION 0.7.4
RUN wget https://github.com/jwilder/docker-gen/releases/download/$DOCKER_GEN_VERSION/docker-gen-linux-amd64-$DOCKER_GEN_VERSION.tar.gz \
    && tar xvzf docker-gen-linux-amd64-$DOCKER_GEN_VERSION.tar.gz -C /usr/local/bin \
    && rm docker-gen-linux-amd64-$DOCKER_GEN_VERSION.tar.gz
ADD conf/buildhosts.tmpl /var/www/buildhosts.tmpl

# Init scripts
ENV PHP_VERSION=${PHP_VERSION}
COPY conf/init.sh /usr/bin/init
RUN chmod 0755 /usr/bin/init
COPY conf/init_crontab.sh /usr/bin/init_crontab
RUN chmod 0755 /usr/bin/init_crontab

EXPOSE 80

# Supervisor
COPY conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD /usr/local/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf -n
