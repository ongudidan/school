FROM vaultke/php8-fpm-nginx

COPY . /var/www/html
WORKDIR /var/www/html
RUN chmod -R 777 /var/www/html