# wp-headless

> Wordpress Headless CMS

## Usage

### Start clean

Copy `dot-env.dist` to `dot-env` and add missing configuration values to the file.

Execute `docker-compose up` and wait for `Admin password` message from `wordpress_1` container. Use this password with 'admin' username to access Wordpress administration interface. Change the password immediately.

### Restore from db backup

Assuming that `dot-env` and `./backup/db.sql.gz` files are in place.

```
$ docker-compose up -d mysql
$ ./run-task db-restore
$ docker-compose up -d wordpress
```
