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

## Run Tests
```
~$ docker-compose exec php php artisan test
```

## Usage
Make an http request to the following endpoint
```
    Url   : http://localhost:8089/rate
    Method: POST
    Parameters : {
        "rate": {
            "energy": fee per kwh,
            "time": fee per hour, 
            "transaction": fee per service
        },
        "cdr": { 
            "meterStart": starting count of electericity meter, 
            "timestampStart": strating process timestamp,
            "meterStop": ending count of electericity meter,
            "timestampStop": ending process timestamp 
        }
    }
    Response: {
        "overall": #,
        "components": {
            "energy": #,
            "time": #,
            "transaction": #
        }
    }
```
## Example http request
```
    POST /rate HTTP/1.1
    Host: localhost:8089
    Accept: application/json
    Content-Type: application/json
    Content-Length: 203
    
    {
    "rate": { "energy": 1.3, "time": 8, "transaction": 8 },
    "cdr": { "meterStart": 1204307, "timestampStart": "2021-04-05T10:04:00Z", "meterStop": 1215230, "timestampStop": "2021-04-05T11:27:00Z" }
    }
```
 
