# Restore from backup

Use `./run-task restore <backupfile>` to restore wpheadless from backup.

```bash
% ./run-task restore snapshots/localhost.tar.gz
```

## Caveats

If backup is restored on environment different from the one where backup was created it may fail.

For example `awslogs` docker logging driver is usually not available on local environment and if backup from aws server is restored locally it will fail because of missing driver.
In this case usually a restored `.env` file must be edited manually after failed restore task.

```bash
% vi .env
% ./docker-compose up -d mysql
% ./run-task wp-snapshot-restore snapshots/localhost.tar.gz
% ./docker-compose up -d
```
