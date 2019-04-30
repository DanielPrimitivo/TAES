START /WAIT .\composer-update-win.sh
START /WAIT .\composer-require-win.sh
php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"
PAUSE