# coordinates-rest-api

### INSTALL

Install dependencies
```sh
composer install
```
Change /.dev db data
```sh
vim .env
```
Run migrations
```sh
php bin/console doctrine:migrations:migrate
```
Run PHP server.
```
$ php -S 127.0.0.1:8000 -t public
```

## DOC

### Prefix: /api/v1/


#### GET /points - get all
#### GET /points/{pointId}") - get one
#### POST /points - add
###### Data  structure (all fields required)
```
type:  1-255 characters string
name:  1-255 characters string
lat: from -90 to 90 float
lng: from -90 to 90 float
```

#### PUT /points/{pointId}") - update 
###### Data  structure (all fields optional)
```
type:  1-255 characters string
name:  1-255 characters string
lat: from -90 to 90 float
lng: from -90 to 90 float
```
#### DELETE /points/{pointId} - delete

#### POST /related-points/{pointId} - link point to point
```
id: integer  - id to linked (child) point
```


### example call:
```
GET http://127.0.0.1:8000/api/v1/points/1
```

### TESTED ON
- PHP 7.2.4 
- MySql 5.7.21
- Postman
