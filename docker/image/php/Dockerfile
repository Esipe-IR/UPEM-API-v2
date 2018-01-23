FROM php:5.6-apache

RUN \
    apt-get update && \
    apt-get install libldap2-dev vim -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

EXPOSE 80
