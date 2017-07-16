FROM phpdockerio/php71-fpm:latest

# Install selected extensions and other stuff
#
RUN apt-get update \
    && apt-get -y --no-install-recommends install mc nano wget git curl php7.1-memcached php7.1-bz2 php7.1-pgsql php7.1-redis php7.1-gd php7.1-imagick php7.1-imap php7.1-intl php7.1-mbstring php7.1-xdebug\
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Xdebug
COPY ./php-fpm/xdebug.ini /etc/php/7.1/fpm/conf.d/20-xdebug.ini
COPY ./php-fpm/xdebug.ini /etc/php/7.1/cli/conf.d/20-xdebug.ini

ARG PUID=
RUN usermod -u ${PUID} www-data
ARG PROJECT_PATH=
WORKDIR ${PROJECT_PATH}

ARG PORT=9000
EXPOSE ${PORT}

CMD ["php-fpm7.1"]