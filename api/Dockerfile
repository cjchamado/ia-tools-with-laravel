FROM php:8.3-cli

ARG REDIS_LIB_VERSION=5.3.7

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libxml2-dev \
    htop \
    nano \
    libbrotli-dev \
    supervisor \
    # wkhtmltopdf
    fontconfig \
    libxrender1 \
    libxtst6 \
    xfonts-75dpi \
    xfonts-base

# wkhtmltopdf
RUN echo "deb http://security.debian.org/debian-security bullseye-security main" >  /etc/apt/sources.list \
  && apt update \
  && apt install libssl1.1 \
  && curl -O https://sierra.nyc3.cdn.digitaloceanspaces.com/assets/wkhtmltox.deb \
  && dpkg -i ./wkhtmltox.deb \
  && rm ./wkhtmltox.deb

RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-jpeg

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_mysql \
    xml \
    simplexml \
    iconv \
    pcntl \
    gd \
    fileinfo \
    exif

RUN pecl install redis-${REDIS_LIB_VERSION} \
    && docker-php-ext-enable redis

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY docker/php.ini "$PHP_INI_DIR/conf.d/99_extra.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

WORKDIR /var/www

CMD [ "./start-dev.sh" ]
