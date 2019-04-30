﻿#!/bin/bash

cp .env.example .env
touch database/database.sqlite
composer install
composer require gmopx/laravel-owm
php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"
php artisan key:generate
php artisan migrate:install
php artisan migrate --seed
