FROM php:8.1-zts-alpine3.15

RUN apk --no-cache update && apk --no-cache add bash
RUN apk add git libzip-dev
RUN docker-php-ext-install pdo pdo_mysql zip

RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

#Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

#Install symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony 

#install node and npm
RUN apk add nodejs npm

COPY . /var/www/html

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer update

RUN chmod +x ./docker/php/entrypoint.sh

ENTRYPOINT ["./docker/php/entrypoint.sh"]