ARG WORDPRESS_VERSION
ARG PHP_VERSION
FROM wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}

ARG CUSTOM_POST_TYPE_UI
ARG ADVANCED_CUSTOM_FIELDS
ARG ACF_TO_REST_API
ARG AMAZON_S3_AND_CLOUDFRONT
ARG AMAZON_WEB_SERVICES
ARG WORDPRESS_IMPORTER
ARG ADMIN_MENU_EDITOR
ARG JWT_AUTHENTICATION_FOR_WP_REST_API

RUN set -ex; \
  apt-get update; \
  apt-get install -y \
    unzip \
  ; \
  rm -rf /var/lib/apt/lists/*; \
  cd /usr/src/wordpress/wp-content/plugins; \
  rm -rf akismet hello.php; \
  curl -sS -O https://downloads.wordpress.org/plugin/custom-post-type-ui.${CUSTOM_POST_TYPE_UI}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/advanced-custom-fields.${ADVANCED_CUSTOM_FIELDS}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/acf-to-rest-api.${ACF_TO_REST_API}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/amazon-s3-and-cloudfront.${AMAZON_S3_AND_CLOUDFRONT}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/amazon-web-services.${AMAZON_WEB_SERVICES}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/wordpress-importer.${WORDPRESS_IMPORTER}.zip; \
  curl -sS -O https://downloads.wordpress.org/plugin/jwt-authentication-for-wp-rest-api.${JWT_AUTHENTICATION_FOR_WP_REST_API}.zip; \
  ls *.zip | xargs -L1 unzip && rm -f *.zip; \
  chown -R www-data: .; \
  curl -sS -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar; \
  chmod +x /usr/local/bin/wp; \
  mkdir ~www-data/.wp-cli; \
  chown www-data: ~www-data/.wp-cli; \
  sed -i '$idocker-wp-headless-entrypoint.sh' /usr/local/bin/docker-entrypoint.sh;

COPY apache.conf /etc/apache2/conf-enabled/wordpress.conf
COPY docker-wp-headless-entrypoint.sh /usr/local/bin/
COPY twentyseventeen-child /usr/src/wordpress/wp-content/themes/twentyseventeen-child

ENV WP_DEFAULT_THEME twentyseventeen-child
