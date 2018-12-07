# wp-headless

> Wordpress Headless CMS to build great API-powered websites, apps and services.

# What is wp-headless?

wp-headless is Wordpress Multisite bundle providing API-only or Headless implementation of the CMS. It comes with fully automated docker based workflow to setup and maintain CMS service on your own server or localhost.

## Features

- Docker is the only dependency on server
- HTTPS only
- Self-signed certificate
- Letsencrypt certificate issue & renew
- Automated backup
- Stage support (production, development)
- Wordpress Multisite secure setup
- SMTP server

## Install

There two executable files in project root: `./docker-compose` - docker-compose wrapper and `./run-task` - runner for scripted tasks from `tasks/` inside docker containers.

Use `run-task` script to install wp-headless.

```
Usage: ./run-task [OPTIONS] install

Options:
  --domain          : Domain to install wp-headless on. Default: localhost.
  --admin-email     : Admin user email. Default webmaster@example.com or webmaster@${DOMAIN} when DOMAIN is set.
  --admin-password  : Wordpress admin password. If not given a random password will be generated.
  --stage           : Production or development. Default: development.
```

For example:

- `./run-task install` - development stage on https://localhost
- `./run-task install --domain=example.com` - development stage on https://example.com
- `./run-task install --domain=example.com --admin-email=webmaster@example.com --admin-password=12345678 --stage=production` - production stage on https://example.com

If password is not specified a random one is generated and printed in command output.

## Backup

Database backup task is executed nightly by cron service.

To restore database from backup file make sure wp-headless is running and execute `./run-task db-restore`.

## Docker service containers

- nginx: [nginx](https://hub.docker.com/_/nginx/)
- mysql: [mariadb](https://hub.docker.com/_/mariadb/)
- php: [tsertkov/php-fpm-wp](https://hub.docker.com/r/tsertkov/php-fpm-wp/)
- smtp: [namshi/smtp](https://hub.docker.com/r/namshi/smtp/)
- cron: [docker](https://hub.docker.com/_/docker/)

## Docker run-task images

`./run-task` runs scripts from `tasks/` inside temporary containers using following images:

- [certbot/certbot](https://hub.docker.com/r/certbot/certbot/)
- [wordpress:cli](https://hub.docker.com/_/wordpress/)

## Similar projects

There are other projects sharing the same idea of using Wordpress as API-only CMS.

- WordPress + React Starter kit https://github.com/postlight/headless-wp-starter
- Rooftop CMS https://github.com/rooftopcms/rooftop-cms
