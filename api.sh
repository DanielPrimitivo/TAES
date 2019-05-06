#!/bin/bash

composer update
composer require gmopx/laravel-owm
php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"