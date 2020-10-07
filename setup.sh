chmod -R 777 storage/
composer install

cp .env.dist .env
# edit database config

php artisan migrate
php artisan db:seed

# add swap memory
# https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-centos-7