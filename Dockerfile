FROM php:7.4.8-fpm-alpine3.12

RUN apk add bash mysql-client
RUN apk add --no-cache openssl
RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

EXPOSE 9000
ENTRYPOINT ["php-fpm" ]