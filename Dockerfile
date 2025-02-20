FROM php:7.4-apache

COPY src/ /var/www/html/

COPY public/ /var/www/html/public/

EXPOSE 80