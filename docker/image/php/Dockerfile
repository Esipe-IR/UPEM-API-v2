FROM php:5.6-apache

RUN \
    apt-get update && \
    apt-get install libldap2-dev vim zlib1g-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap && \
    docker-php-ext-install zip && \
    curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    echo "[PHP]" > /usr/local/etc/php/php.ini && \
    echo "date.timezone = Europe/Paris" >> /usr/local/etc/php/php.ini

EXPOSE 80
