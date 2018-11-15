ARG WORDPRESS_VERSION
ARG PHP_VERSION
FROM wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}

ARG ACF_PRO_VERSION
ARG WORDPRESS_PLUGINS
ENV WORDPRESS_PLUGINS $WORDPRESS_PLUGINS

RUN set -e; \
  apt-get update; \
  apt-get install -y \
    unzip \
  ; \
  rm -rf /var/lib/apt/lists/*; \
  sed -i '$idocker-wp-headless-entrypoint.sh' /usr/local/bin/docker-entrypoint.sh; \
  cd /usr/src/wordpress/wp-content/themes; \
  rm -rf \
    twentyfifteen \
    twentysixteen \
    ; \
  cd /usr/src/wordpress/wp-content/plugins; \
  rm -rf \
    akismet \
    hello.php \
    ; \
  PLUGINS="$( \
    echo $WORDPRESS_PLUGINS \
    | sed -e 's/\(\S\+\)\s\(\S\+\)\s*/\1.\2.zip\n/g' \
    | sed -e '/^\s*$/d' \
    )"; \
  for plugin_file in $PLUGINS; do \
    curl -sS -O "https://downloads.wordpress.org/plugin/${plugin_file}"; \
  done; \
  curl -sS -O -L "https://github.com/wp-premium/advanced-custom-fields-pro/archive/${ACF_PRO_VERSION}.zip"; \
  unzip "${ACF_PRO_VERSION}.zip" > /dev/null; \
  rm "${ACF_PRO_VERSION}.zip"; \
  mv "advanced-custom-fields-pro-${ACF_PRO_VERSION}" "advanced-custom-fields-pro"; \
  curl -s -O -L "https://github.com/tsertkov/content-update-notifier/archive/master.zip"; \
  unzip "master.zip" > /dev/null; \
  rm "master.zip"; \
  mv "content-update-notifier-master" "content-update-notifier"; \
  ls *.zip | xargs -L1 unzip > /dev/null && rm -f *.zip; \
  chown -R www-data: .; \
  cd; \
  curl -sS \
    -o /usr/local/bin/wp \
    https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar; \
  chmod +x /usr/local/bin/wp; \
  mkdir ~www-data/.wp-cli; \
  chown www-data: ~www-data/.wp-cli;

COPY apache.conf /etc/apache2/conf-enabled/wordpress.conf
COPY docker-wp-headless-entrypoint.sh /usr/local/bin/

ENV WP_DEFAULT_THEME twentyseventeen-child
COPY $WP_DEFAULT_THEME /usr/src/wordpress/wp-content/themes/${WP_DEFAULT_THEME}
