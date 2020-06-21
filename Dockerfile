FROM php:7.4-cli

RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev zip unzip \
	&& docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /opt/tbot

ENV GENERAL_TWEET_ENABLED 1
ENV GENERAL_MESSAGE User %s has posted %d tweets today.

COPY bot.php       bot.php
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN php /usr/local/bin/composer install --no-dev

ENTRYPOINT [ "php", "bot.php" ]