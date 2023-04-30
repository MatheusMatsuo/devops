FROM php:8.0.2-apache

WORKDIR /var/www/html

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN apt-get update && \
    apt-get install -y \
        curl \
        git \
        libzip-dev \
        unzip \
        zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pdo pdo_mysql gd zip exif

RUN docker-php-ext-install mysqli pdo pdo_mysql exif

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

COPY ./laravel /var/www/html/

RUN composer install

RUN npm install && npm run dev

RUN chmod -R 777 /var/www/html/storage/

COPY ./laravel-default.conf /etc/apache2/sites-available/

RUN a2dissite 000-default.conf && a2ensite laravel-default.conf
RUN a2enmod rewrite

EXPOSE 80