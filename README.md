# Description
Utility, like `LAMP`, to fast build server environment on Windows 10 with Docker.

# Requirements
- Windows 10 - tested with `Windows 10 21H1`.
- Windows Subsystem for Linux - `WSL` and `WSL 2`.
- Ubuntu from Windows Store - tested with `Ubuntu 20.04 TLS`.
- Docker on Ubuntu - tested with `Docker 20.10.2`.
- Docker-Compose on Ubuntu - tested with `Docker-Compose 1.25.0`.

# Installation
Run docker commands with `sudo` or configure docker to run without it and make sure that `mysql_docker_container/etc/mysql/my.conf` file has `644` permissions.
1. Run `git clone git@github.com:dayvudev/mpnv.git .`.
1. Run `docker-compose up`. If docker deamon is not running, try to run `dockerd &`.

# Configuration
### MySQL on port 5101
1. Port is configured in the `services.mysql_docker_container.ports` section in `docker-compose.yml`.
1. User credentials are configured in the `services.mysql_docker_container.environment` section in `docker-compose.yml`.
### PHP on port 5102
1. Site files are stored in the `php_docker_container/root` directory.
1. PHP configuration files are stored in the `php_docker_container/usr/local/etc` directory.
### Nginx on port 5103
1. Listening ports are configured in the `http.server.list` sections in `nginx_docker_container/nginx.conf`.
1. PHP is configured in the `http.server.location.fastcgi_pass` sections in `nginx_docker_container/nginx.conf`.
### Varnish on port 5104
1. Varnish is simply configured in the `php_docker_container/default.vcl` file.

# Testing
### Without Varnish
1. Open address `http://127.0.0.1:5103` in a web browser. Three site headers should be visible
    - "PHP State" - The message below that header should be "It works!".
    - "MySQL State" - The message below that header should be "It works!".
    - "Varnish State" - The message below that header should be "It doesn't works!".
### With Varnish
1. Open address `http://127.0.0.1:5104` in a web browser. Three site headers should be visible
    - "PHP State" - The message below that header should be "It works!".
    - "MySQL State" - The message below that header should be "It works!".
    - "Varnish State" - The message below that header should be "It works!" and additional informations should be visible.
1. Change something in the `php_docker_container/root/index.php`.
The change should be visible on address `http://127.0.0.1:5103`, but not on `http://127.0.0.1:5104`.
1. Open address `http://127.0.0.1:5104/purge`. The change should be visible on both sites now.
1. Check other addresses:
    - `http://127.0.0.1:5104/pipe`
    - `http://127.0.0.1:5104/pass`

