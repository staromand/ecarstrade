#!/usr/bin/make
include var/www/.env
export $(shell sed 's/=.*//' var/www/.env)
compose=docker-compose -f docker-compose.yml

.DEFAULT_GOAL := build

.PHONY: init
init: build start composer

.PHONY: build
build:
		$(compose) build

.PHONY: start
start:
		$(compose) up -d

.PHONY: down
down:
		$(compose) down

.PHONY: composer
composer:
		$(compose) exec php-fpm composer install

.PHONY: import-cars
import-cars:
		$(compose) exec php-fpm php bin/import-cars

.PHONY: stats
stats:
		$(compose) exec php-fpm php bin/cars-stats
