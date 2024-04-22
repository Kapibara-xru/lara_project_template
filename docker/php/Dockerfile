FROM php:8.3-fpm as php_base

ARG REMOTE_HOST

ENV TZ=Europe/Moscow
ENV DEPENDENSIES="curl git cron zip unzip supervisor xvfb wkhtmltopdf libfreetype6-dev libjpeg62-turbo-dev libaio1 libaio-dev libpng-dev libzip-dev libicu-dev zlib1g-dev libpq-dev libldap2-dev libxml2-dev libsodium-dev libcap2-bin librsvg2-bin"
ENV EXTENSIONS="bcmath pdo pdo_pgsql intl sockets zip ldap soap opcache sodium"

# Install system dependencies
RUN apt-get update \
    && apt-get install -y ${DEPENDENSIES} \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) ${EXTENSIONS}

RUN ln -s /usr/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf \
    && ln -s /usr/bin/wkhtmltoimage /usr/local/bin/wkhtmltoimage \
    && strip --remove-section=.note.ABI-tag /usr/lib/x86_64-linux-gnu/libQt5Core.so.5

# Install Xdebug
RUN pecl install -f xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.client_host=$REMOTE_HOST" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && mkdir -p /var/xdebug/profiler \
    && chmod -R 777 /var/xdebug \
    && touch /tmp/xdebug.log \
    && chmod 777 /tmp/xdebug.log

# Copy php config
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www
USER www

WORKDIR /var/www

EXPOSE 9000

CMD composer install && php-fpm
