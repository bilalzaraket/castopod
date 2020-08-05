FROM php:7.2-fpm

COPY . /castopod
WORKDIR /castopod

### Install CodeIgniter's server requirements
#-- https://github.com/codeigniter4/appstarter#server-requirements

# Install intl extension using https://github.com/mlocati/docker-php-extension-installer
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    zlib1g-dev \
    && docker-php-ext-install intl gd

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN echo "file_uploads = On\n" \
         "memory_limit = 100M\n" \
         "upload_max_filesize = 100M\n" \
         "post_max_size = 120M\n" \
         > /usr/local/etc/php/conf.d/uploads.ini
