<?php
# PHP template file for generating wp-config.php
# Helper function to simplify environment variables access
function e ($envVarName) { echo getenv($envVarName); }
echo '<?php', PHP_EOL;
?>
#
# Custom wp-config.php for wp-headless
#

define('FORCE_SSL_ADMIN', true);
define('WP_DEFAULT_THEME', 'wpheadless');
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', '<?php e('DOMAIN')?>');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISALLOW_FILE_MODS', true);
define('WPMU_PLUGIN_DIR', '/var/www/mu-plugins');
define('DISABLE_WP_CRON', true);
define('WP_MAIL_FROM_NAME', '<?php e('MAIL_FROM_NAME')?>');
define('WP_MAIL_FROM_EMAIL', '<?php e('MAIL_FROM_EMAIL')?>');
$base = '/';

if (
  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
  $_SERVER['HTTPS'] = 'on';
}

# Extracted from wp-config-sample.php

define('DB_NAME', '<?php e('DB_NAME')?>');
define('DB_USER', '<?php e('DB_USER')?>');
define('DB_PASSWORD', '<?php e('DB_PASSWORD')?>');
define('DB_HOST', '<?php e('DB_HOST')?>');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('AUTH_KEY', '<?php e('AUTH_KEY')?>');
define('SECURE_AUTH_KEY', '<?php e('SECURE_AUTH_KEY')?>');
define('LOGGED_IN_KEY', '<?php e('LOGGED_IN_KEY')?>');
define('NONCE_KEY', '<?php e('NONCE_KEY')?>');
define('AUTH_SALT', '<?php e('AUTH_SALT')?>');
define('SECURE_AUTH_SALT', '<?php e('SECURE_AUTH_SALT')?>');
define('LOGGED_IN_SALT', '<?php e('LOGGED_IN_SALT')?>');
define('NONCE_SALT', '<?php e('NONCE_SALT')?>');
define('WP_DEBUG', false);
$table_prefix = 'wp_';

if ( !defined('ABSPATH') ) define('ABSPATH', dirname(__FILE__) . '/html/');
require_once(ABSPATH . 'wp-settings.php');
