#!/bin/bash

composer update
php artisan migrate:refresh --seed
