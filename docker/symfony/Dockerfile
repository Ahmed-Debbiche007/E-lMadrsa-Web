FROM ubuntu:latest

ARG DEBIAN_FRONTEND=noninteractive

RUN apt update
RUN apt install apache2 -y
RUN apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt install php8.1 libapache2-mod-php8.1 php8.1-common php8.1-sqlite3 php8.1-mysql php8.1-gmp php8.1-curl php8.1-intl php8.1-mbstring php8.1-xmlrpc php8.1-soap php8.1-ldap php8.1-gd php8.1-bcmath php8.1-xml php8.1-cli php8.1-zip -y 1

COPY ./docker/symfony/php.ini /etc/php/8.1/apache2/php.ini

RUN apt install curl git -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt install -y apache2-utils
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash -E
RUN apt install symfony-cli
RUN apt clean

COPY . /var/www
WORKDIR /var/www

ENV COMPOSER_ALLOW_SUPERUSER=1

# RUN composer install
RUN composer install
EXPOSE 80

