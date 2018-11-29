# wp-headless

> Wordpress Headless CMS to build great API-powered websites, apps and services.

# What is wp-headless?

wp-headless is Wordpress Multisite bundle providing API-only or Headless implementation of the CMS. It comes with fully automated docker based workflow to setup and maintain CMS service on your own server or localhost.

## Features

- Docker is the only dependency on server
- HTTPS only
- Self-signed certificate
- Letsencrypt certificate issue
- Letsencrypt certificate renew automation
- Automated nightly Wordpress backup
- Stage support (production, development)
- Wordpress Multisite secure setup
- SMTP server

## Install

There two executable files in project root: `./docker-compose` - docker-compose wrapper and `./run-task` - runner for scripted tasks from `tasks/` inside docker containers.

- `cp dot-env.dist dot-env` - Copy `dot-env.dist` to `dot-env` then edit configuration parameters
- `./run-task openssl-dhparam` - Generate DH params for nginx
- `./run-task openssl-self-signed` or `./run-task leissue` - Get ssl certificate
- `./docker-compose up -d` - Bring up services
- `./run-task wp-install` - Download and configure Wordpress with custom plugins and themes

After executing `wp-install` task you should find Wordpress admin user password in the logs. Do not forget to change it!

## Restore from backup

It is expected that dhparam and ssl certificates are in place already.

- `./docker-compose up -d` - Bring up services
- `./run-task wp-install` - Install clean wp-headless
- `./run-task db-restore` - Restore database from backup file

Please note that Wordpress uploads folder is not backed up since uploads supposed to be hosted on AWS S3.

## Service containers

- nginx: [nginx](https://hub.docker.com/_/nginx/)
- mysql: [mariadb](https://hub.docker.com/_/mariadb/)
- php: [tsertkov/php-fpm-wp](https://hub.docker.com/r/tsertkov/php-fpm-wp/)
- smtp: [namshi/smtp](https://hub.docker.com/r/namshi/smtp/)
- cron: [docker](https://hub.docker.com/_/docker/)

## Run-task images

`./run-task` runs scripts from `tasks/` inside temporary containers using following images:

- [certbot/certbot](https://hub.docker.com/r/certbot/certbot/)
- [wordpress:cli](https://hub.docker.com/_/wordpress/)

## Similar projects

There are other projects sharing the same idea of using Wordpress as API-only CMS.

- WordPress + React Starter kit https://github.com/postlight/headless-wp-starter
- Rooftop CMS https://github.com/rooftopcms/rooftop-cms
