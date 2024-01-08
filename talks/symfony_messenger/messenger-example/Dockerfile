# First stage: Install composer dependencies
FROM composer:2.4 as composer-build

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN apk add --no-cache openssh-client git
RUN mkdir -p ~/.ssh && ssh-keyscan github.com >> ~/.ssh/known_hosts

RUN --mount=type=ssh,required=true composer install \
    --no-interaction \
    --no-dev \
    --no-scripts \
    --no-progress \
    --ignore-platform-reqs
# Second stage: Install PHP extensions
FROM php:8.1-fpm as php-extensions-build

# Install dependencies for php extensions
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
 && rm -rf /var/lib/apt/lists/*

RUN pecl install redis

RUN docker-php-ext-install -j$(nproc) bcmath gd pdo pdo_pgsql soap zip pgsql gd

# Final build, our "base" for others
FROM php:8.1-fpm as app

COPY --from=php-extensions-build /usr/local/lib/php/extensions/no-debug-non-zts-20210902/ /usr/local/lib/php/extensions/no-debug-non-zts-20210902/
COPY --from=php-extensions-build /usr/lib/*-linux-gnu /usr/lib/

RUN docker-php-ext-enable bcmath gd pdo pdo_pgsql soap zip pgsql gd redis

COPY docker/php/app.ini /usr/local/etc/php/conf.d/app.ini

COPY docker/php/app.ini /usr/local/etc/php/conf.d/app.ini

COPY --chown=www-data:www-data --from=composer-build /app/vendor /var/www/html/vendor/
COPY --chown=www-data:www-data . /var/www/html/

EXPOSE 9000


# Release stage, the release that will go on our servers
FROM app as release

# Add production configuration
COPY docker/php/production.ini /usr/local/etc/php/conf.d/production.ini
# Enable opcache
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN docker-php-ext-enable opcache

USER www-data

ENV APP_ENV prod

RUN bin/console assets:install && rm -rf var/

FROM app as dev-back

COPY --from=composer-build /usr/bin/composer /usr/bin/composer

RUN --mount=type=ssh,required=true composer install \
    --no-interaction \
    --no-progress \
    --ignore-platform-reqs \
    --no-scripts

FROM app