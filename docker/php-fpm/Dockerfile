FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libicu-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    nano \
    git \
    libexif-dev \
    libxrender1 \
    libfontconfig \
#    && pecl install mcrypt-1.0.3 \
#    && docker-php-ext-enable mcrypt \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) zip intl curl pdo_mysql tokenizer \
    && docker-php-ext-install exif \
    && rm -rf /var/lib/apt/lists/*
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/  &&  \
    docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer |  php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /app
WORKDIR /app
ADD app /app

RUN usermod -u 1000 www-data

RUN chmod -R 777 /app/public
COPY docker/php-fpm/uploads.ini /usr/local/etc/php/conf.d

RUN composer install \
    && php artisan key:generate \
    && chmod 777 -R storage \
    && chmod 777 -R public \
    && chmod 777 -R bootstrap
#    && php artisan migrate --seed

RUN curl -sL https://deb.nodesource.com/setup_14.x |  bash -E - \
    && apt update \
    && apt-get install -y nodejs \
    && curl -L https://npmjs.org/install.sh | sh \
    && npm install --global cross-env \
    && npm install \
    && npm run dev
