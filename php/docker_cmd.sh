#!/usr/bin/env bash

# enable php.ini-production
cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# symlink additional configs
ln -sf /usr/local/wpheadless/conf.d/* /usr/local/etc/php/conf.d/
ln -sf /usr/local/wpheadless/php-fpm.d/* /usr/local/etc/php-fpm.d/

exec php-fpm
