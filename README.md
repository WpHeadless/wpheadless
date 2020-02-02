# WpHeadless

> Wordpress Headless Bundle to build great API-powered websites, apps and services.

# What is WpHeadless?

WpHeadless is Wordpress Multisite bundle providing API-only or Headless implementation of the CMS and static site web-server. It comes with fully automated docker based workflow to setup and maintain CMS service on your own server or https://localhost.

## tl;dr

```
$ git clone https://github.com/WpHeadless/wpheadless.git && wpheadless/run-task install
$ open https://localhost
```

## Features

- Docker is the only dependency
- HTTPS only
- SSL/TLS certificates: Letsencrypt, Self-signed, mkcert
- Nightly backup
- Wordpress Multisite secure setup
- Static web-server vhost routing
- Local SMTP server
- Fine tuned /wp-admin for headless use-case

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
  --letsencrypt     : Request certificate with letsencrypt if set to "true".
  --docker-env      : Docker environment: local, aws
  --aws-logs-group  : Aws logs group name for docker awslogs driver
```

For example:

- `./run-task install` - installs https://localhost
- `./run-task install --domain=example.com` - installs https://example.com

```
$ ./run-task install \
  --domain=example.com \
  --admin-email=webmaster@example.com \
  --admin-password='1 2 3 4 5 6 7 8' \
  --letsencrypt=true \
  --docker-env=aws \
  --aws-use-ec2-iam-role=true \
  --aws-logs-group=example-com-whpeadless
```

> When password is not specified a random one is generated and sent to stdout.

## Scheduler

WpHeadless contains scheduler service powered by cron running in dedicated lightweight container.

Jobs executed by scheduler:

- Nightly backup
- Letsencrypt certificate renew or issue

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
