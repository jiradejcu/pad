chmod -R 777 storage/
composer install

cp .env.dist .env
# edit database config

php artisan migrate
php artisan db:seed
