cd /app
php artisan migrate
cp .env.example .env
php artisan key:generate
composer install