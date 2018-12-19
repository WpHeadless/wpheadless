# WpHeadless

> Wordpress Headless CMS to build great API-powered websites, apps and services.

# What is WpHeadless?

WpHeadless is Wordpress Multisite bundle providing API-only or Headless implementation of the CMS and static site web-server. It comes with fully automated docker based workflow to setup and maintain CMS service on your own server or https://localhost.

## TL;DR;

```
$ git clone https://github.com/WpHeadless/wpheadless.git && wpheadless/run-task install
$ open https://localhost
``` 

## Features

- Docker is the only dependency
- HTTPS only
- Self-signed certificate
- Letsencrypt certificate issue & renew
- Nightly backup
- Stage support: `production`, `development`
- Wordpress Multisite secure setup
- Static site web-server (HTTP only)
- SMTP server

## Install

There are two executable files in the project root:
- `./docker-compose` - `docker-compose` wrapper. Use it just like real `docker-compose`.
- `./run-task` - Task runner executing scripts from `tasks/` directory in containers.

Use `run-task` to install WpHeadless.

```
Usage: ./run-task [OPTIONS] install

Options:
  --domain          : Domain to install WpHeadless on. Default: localhost.
  --admin-email     : Admin user email. Default webmaster@example.com or webmaster@${DOMAIN} when DOMAIN is set.
  --admin-password  : Wordpress admin password. If not given a random password will be generated.
  --stage           : Production or development. Default: development.
```

For example:

- `./run-task install` - development stage on https://localhost
- `./run-task install --domain=example.com` - development stage on https://example.com

```
$ ./run-task install \
  --domain=example.com \
  --admin-email=webmaster@example.com \
  --admin-password='1 2 3 4 5 6 7 8' \
  --stage=production
```

> When password is not specified a random one is generated and sent to stdout.

## Scheduler

WpHeadless contains scheduler service powered by cron running in dedicated lightweight container.

Jobs executed by scheduler:

- Nightly backup
- Letsencrypt certificate renew or issue (`production` stage only)

## Docker service containers

- nginx: [nginx](https://hub.docker.com/_/nginx/)
- mysql: [mariadb](https://hub.docker.com/_/mariadb/)
- php: [wpheadless/wp-php-fpm](https://hub.docker.com/r/wpheadless/wp-php-fpm/)
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

## Content as a service (CaaS) providers

- https://contentful.com
- https://prismic.io
