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
        unzip \
        curl \
        git \
        bash \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
    && apk del --no-cache postgresql-dev

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настраиваем пользователя и права
RUN chown -R www-data:www-data /var/www/laravel \
    && chmod -R 755 /var/www/laravel

# Открываем порт (опционально, если нужно)
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]