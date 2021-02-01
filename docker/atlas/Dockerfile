#start with our base image (the foundation) - version 7.1.5
FROM php:7.2-apache

#install all the system dependencies and enable PHP modules
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      pandoc \
      texlive-latex-base \
      texlive-latex-recommended \
      texlive-fonts-recommended \
      libmcrypt-dev \
      default-mysql-client \
      git \
      zlib1g-dev \
      zip \
      unzip \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install \
      intl \
      mbstring \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      zip \
      opcache

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

#set our application folder as an environment variable
ENV APP_HOME /var/www/html

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to cakephp /var/www/html/webroot folder
RUN sed -i -e "s/html/html\/webroot/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

#copy source files and run composer
COPY . $APP_HOME

# Get the INI file installed.
COPY ./php.ini /usr/local/etc/php

# install all PHP dependencies
RUN composer install --no-interaction

#change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME
