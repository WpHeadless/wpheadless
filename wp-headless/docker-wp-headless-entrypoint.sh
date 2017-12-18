#!/usr/bin/env bash

set -e
set -o pipefail

test -e index.php -a -e wp-includes/version.php || exit 0
wp core is-installed --allow-root && exit

# enable www-data user
usermod -s /bin/bash www-data

su www-data <<'EOF'
wp core multisite-install \
  --url="$WORDPRESS_URL" \
  --title="$WORDPRESS_TITLE" \
  --admin_email="$WORDPRESS_ADMIN_EMAIL" \
  --skip-email

sed -i "2idefine('DBI_AWS_ACCESS_KEY_ID', '${DBI_AWS_ACCESS_KEY_ID}');" wp-config.php
sed -i "2idefine('DBI_AWS_SECRET_ACCESS_KEY', '${DBI_AWS_SECRET_ACCESS_KEY}');" wp-config.php
sed -i "2idefine('FORCE_SSL_ADMIN', ${FORCE_SSL_ADMIN});" wp-config.php
sed -i "2idefine('JWT_AUTH_SECRET_KEY', '${JWT_AUTH_SECRET_KEY}');" wp-config.php

wp plugin activate custom-post-type-ui --network
wp plugin activate advanced-custom-fields --network
wp plugin activate acf-to-rest-api --network
wp plugin activate amazon-web-services --network
wp plugin activate wordpress-importer --network
wp plugin activate amazon-s3-and-cloudfront --network
wp plugin activate jwt-authentication-for-wp-rest-api --network
wp plugin activate wp-force-login --network

wp theme disable twentyseventeen --network
wp theme enable twentyseventeen-child --network --activate
EOF

# disable www-data user
usermod -s /bin/sbin/nologin www-data
