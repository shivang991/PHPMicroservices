FROM php:8.3-apache as final
# RUN docker-php-ext-install pdo pdo_mysql

COPY ./index.php /var/www/html/index.php

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

USER www-data
