# Mysql proxy

To expose MySQL port on localhost use mysql-proxy task:

```
% ./run-task mysql-proxy
Socat started listening on 3306: Redirecting traffic to mysql:3306 (6)
```

## Connecting to remote host

Ssh tunneling can be used to expose mysql running inside docker container on remote machine to localhost.

```
% ssh -L localhost:3306:localhost:3306 example.com -- /wpheadless/run-task mysql-proxy
```
