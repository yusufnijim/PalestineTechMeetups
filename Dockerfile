#FROM php:5.6-apache

FROM php:7-apache

#RUN apt-get update
#    /usr/local/bin/docker-php-ext-install gd mysqli && \

#RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN \
    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && \
    docker-php-ext-configure mysqli --with-mysqli=mysqlnd && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install mbstring


RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

RUN curl -sS https://getcomposer.org/installer | php -- --version=$(curl -s https://api.github.com/repos/composer/composer/releases/latest | grep -oP '"tag_name": "\K[^"]+')  --install-dir=/usr/bin --filename=composer