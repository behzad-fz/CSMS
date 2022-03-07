# CSMS (Charging Station Management System)

## Requirements:
- Docker
- Docker-compose

## Dockerized Environment:
- NGINX
- PHP-FPM

## Installation Guide
Run below commands into your terminal:

NOTICE: if your port 8089 is already in use, please set DOCKER_HTTP_PORT to free port in .env file.

```
~$ git clone https://github.com/behzad-fz/CSMS.git
~$ cd CSMS
~$ cp .env.example .env
~$ docker-compose build
~$ docker-compose up -d
~$ docker-compose exec php composer install
~$ docker-compose exec php php artisan key:generate
```

Now app should be alive on http://localhost:8089
