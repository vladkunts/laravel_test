## Laravel Interview project

Small project to manage clients and their transactions

### How to start

An assembly based on Laravel Sail is used.

```bash
composer install
```

Before starting, copy .env.example to .env

Launch Laravel Sail
```bash
./vendor/bin/sail up
```

```bash
php artisan storage:link

php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan config:cache

php artisan migrate
php artisan db:seed
npm install
npm run dev
```