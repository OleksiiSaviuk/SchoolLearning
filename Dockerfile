FROM php:7.4-apache

RUN docker-php-ext-install mysqli
COPY src/ /var/www/html/
COPY public/ /var/www/html/public/

EXPOSE 80