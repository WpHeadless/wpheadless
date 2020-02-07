#!/usr/bin/env sh
set -e
apk --update add curl
crontab cron/crontab
exec crond -f -d 8
