#!/usr/bin/env bash

set -e
set -o pipefail

test -e index.php -a -e wp-includes/version.php || exit 0

# enable www-data user
usermod -s /bin/bash www-data

su www-data <<'EOF'
set -eo pipefail

if ! wp core is-installed --network; then
  wp core multisite-install \
    --url="$WORDPRESS_URL" \
    --title="$WORDPRESS_TITLE" \
    --admin_email="$WORDPRESS_ADMIN_EMAIL" \
    --skip-email
fi

wp theme disable twentyseventeen --network
wp theme enable twentyseventeen-child --network --activate

echo "<?php
define('DBI_AWS_ACCESS_KEY_ID', '${DBI_AWS_ACCESS_KEY_ID}');
define('DBI_AWS_SECRET_ACCESS_KEY', '${DBI_AWS_SECRET_ACCESS_KEY}');
define('FORCE_SSL_ADMIN', ${FORCE_SSL_ADMIN});
define('JWT_AUTH_SECRET_KEY', '${JWT_AUTH_SECRET_KEY}');
define('WP_DEFAULT_THEME', '${WP_DEFAULT_THEME}');
" > wp-config-headless.php

sed -i "1c<?php require __DIR__ . '/wp-config-headless.php';" wp-config.php

PLUGINS="$( \
  echo $WORDPRESS_PLUGINS \
    | sed -e 's/\(\S\+\)\s\S\+\s*/\1\n/g' \
    | sed -e '/^\s*$/d'
)"

for plugin_name in $PLUGINS; do
  wp plugin activate "$plugin_name" --network
done

for plugin_url in $WORDPRESS_RUNTIME_PLUGINS; do
  wp plugin install "$plugin_url" --activate-network
done

EOF

# disable www-data user
usermod -s /bin/sbin/nologin www-data
