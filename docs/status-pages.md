# Status pages

PHP fpm exposes /php-statusz and /php-healthz endpoints callable from nginx
container as http://127.0.0.1/php-statusz and http://127.0.0.1/php-healthz
respectively.

See https://www.php.net/manual/en/install.fpm.configuration.php#pm.status_path,
https://www.php.net/manual/en/install.fpm.configuration.php#ping.path.
