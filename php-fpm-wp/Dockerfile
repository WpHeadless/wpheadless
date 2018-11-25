FROM php:7.2-fpm

# install the PHP extensions we need
RUN set -ex; \
  \
  savedAptMark="$(apt-mark showmanual)"; \
  \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    libjpeg-dev \
    libpng-dev \
  ; \
  \
  docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
  docker-php-ext-install gd mysqli opcache zip; \
  \
# reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
  apt-mark auto '.*' > /dev/null; \
  apt-mark manual $savedAptMark; \
  ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
    | awk '/=>/ { print $3 }' \
    | sort -u \
    | xargs -r dpkg-query -S \
    | cut -d: -f1 \
    | sort -u \
    | xargs -rt apt-mark manual; \
  \
  apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
  rm -rf /var/lib/apt/lists/*

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
  } > /usr/local/etc/php/conf.d/opcache-recommended.ini; \
  cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini; \
  { \
    echo 'php_admin_value[upload_max_filesize] = 16M'; \
    echo 'php_admin_value[post_max_size] = 16M'; \
    echo 'php_admin_value[upload_tmp_dir] = /tmp'; \
    echo 'php_admin_value[session.save_path] = /tmp'; \
    echo 'php_admin_value[open_basedir] = /var/www:/tmp'; \
  } >> /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www
