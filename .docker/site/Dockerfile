FROM php:7.2-apache
RUN apt-get update
RUN apt-get install -y curl libmcrypt-dev libc6 libstdc++6
RUN apt-get update
RUN apt-get install -y libcurl4-gnutls-dev libexpat1-dev gettext libz-dev libssl-dev git

RUN apt-get install -y locales \
        && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
        && locale-gen

# Install Heroku CLI
RUN apt-get -y install gnupg gnupg2 gnupg1 wget
RUN wget -qO- https://cli-assets.heroku.com/install-ubuntu.sh | sh

RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install redis-4.0.0 && docker-php-ext-enable redis
RUN pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug

ADD apache2.conf /etc/apache2/sites-enabled/000-default.conf
ADD chatbot-site.conf /etc/apache2/sites-enabled/chatbot-site.conf
ADD cert1.crt /var/www/cert1.crt
ADD cert1.key /var/www/cert1.key

RUN a2enmod rewrite
RUN a2enmod ssl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_DISABLE_XDEBUG_WARN 1

WORKDIR /var/www/chatbot

CMD ["apache2-foreground"]