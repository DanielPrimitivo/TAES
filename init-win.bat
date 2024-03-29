copy .env.example .env
fsutil file createnew .\database\database.sqlite 0
start /WAIT .\composer-install-win.bat
start /WAIT .\composer-require-win.bat
php artisan vendor:publish --provider="Gmopx\LaravelOWM\LaravelOWMServiceProvider"
php artisan key:generate
copy SQLiteConnector.php.example ./vendor/laravel/framework/src/Illuminate/Database/Connectors/SQLiteConnector.php
php artisan migrate:install
php artisan migrate --seed
PAUSE