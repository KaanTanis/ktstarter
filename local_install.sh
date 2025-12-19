#######################################################
## Only run this script in local development environment. Only for initial setup.
#######################################################

# create database folder and sqlite file
touch database/database.sqlite

# setup application
cp .env.example .env

# install dependencies and setup application
npm install

# install dependencies and setup application
composer install

# generate application key
php artisan key:generate

# run migrations and seeders
php artisan migrate --seed

# build frontend assets
npm run build

# create storage symlink
php artisan storage:link

# clear caches and optimize application
php artisan optimize:clear
