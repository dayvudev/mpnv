FROM php:7.3-fpm
WORKDIR /var/project/root

##############################################################################
#### Packages installation
##############################################################################
RUN apt-get update
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN yes | apt-get install procps iputils-ping
RUN docker-php-ext-install pdo pdo_mysql