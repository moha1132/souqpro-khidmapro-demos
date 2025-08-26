
FROM php:8.3-cli-alpine
RUN apk add --no-cache oniguruma-dev libzip-dev zip sqlite sqlite-dev && docker-php-ext-install pdo_sqlite
WORKDIR /app
COPY composer.json composer.lock* /app/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer  && rm composer-setup.php  && composer install --no-dev --prefer-dist --no-interaction --no-progress || true
COPY . /app
RUN chmod +x /app/start.sh
EXPOSE 8080
CMD ["/app/start.sh"]
