FROM php:8.2-fpm-alpine

# Устанавливаем рабочую директорию
WORKDIR /var/www/laravel

# Устанавливаем зависимости, необходимые для PostgreSQL и других расширений
RUN set -ex \
    && apk --no-cache add \
        postgresql-dev \
        libpq \
        libxml2-dev \
        oniguruma-dev \
        icu-dev \
        zip \
        gd \
        libpng-dev \
        libjpeg-turbo-dev \
        unzip \
        curl \
        imagemagick-dev \
        freetype-dev \
        libwebp-dev\
        autoconf \
        gcc \
        g++ \
        make \
        git \
        bash \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del --no-cache postgresql-dev imagemagick-dev autoconf gcc g++ make


# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настраиваем пользователя и права
RUN chown -R www-data:www-data /var/www/laravel \
    && chmod -R 777 /var/www/laravel

# Открываем порт (опционально, если нужно)
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]