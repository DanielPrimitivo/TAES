START /WAIT .\composer-update-win.bat
php artisan migrate:refresh --seed
PAUSE