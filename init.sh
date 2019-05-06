#!/bin/bash

cp .env.example .env
touch database/database.sqlite
composer install
composer require gmopx/laravel-owm
php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"
php artisan key:generate
cp SQLiteConnector.php.example ./vendor/laravel/framework/src/Illuminate/Database/Connectors/SQLiteConnector.php
php artisan migrate:install
php artisan migrate --seed

