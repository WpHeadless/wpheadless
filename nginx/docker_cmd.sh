#!/usr/bin/env sh

set -e
DOLLAR=$ envsubst < /etc/nginx/nginx.conf.tpl > /etc/nginx/nginx.conf;
exec nginx -g "daemon off;"
