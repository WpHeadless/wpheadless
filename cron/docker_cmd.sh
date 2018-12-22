#!/usr/bin/env sh
set -e
crontab cron/crontab
exec crond -f -d 8
