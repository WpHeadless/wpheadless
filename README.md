# wp-headless

> Wordpress Headless CMS to build great API-powered sites and services.

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
