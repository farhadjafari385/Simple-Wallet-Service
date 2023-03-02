## Wallet Service Guide

### Build Image:

Build our docker file image for making our project ready to use.

```shell
docker compose build
```

### Create Service:


Create and Run our container. 

```shell
docker compose up -d
```


### Migrate Database:

```shell
docker compose exec wallet-service-master php artisan migrate --seed
```


### Fresh Database:

```shell
docker compose exec wallet-service-master php artisan migrate:fresh --seed
```


### Refresh Database:

```shell
docker compose exec wallet-service-master php artisan migrate:refresh --seed
```


### Restart Service:

```shell
docker compose restart
```


### Restart Specific Service:

```shell
docker compose {service_name} restart
```


### Execute Command on Service:

```shell
docker compose run {service_name} bash
```

