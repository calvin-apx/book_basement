# Book Basement

Book Basement is a web platform for giving books a second life. Users donate, sell, buy, and recycle books through the companion Android app, and administrators manage inventory, appointments, and recommendations from this Laravel dashboard.

Companion app: [BookBasementMobileApp](https://github.com/calvin-apx/BookBasementMobileApp)

## Features

- **Admin dashboard** with sales and inventory charts
- **Book inventory** with genres, cover images, and DataTables listings
- **Appointments** for donating, selling, and buying books, which admins mark done or cancelled
- **Cart, favorites, and recommendations** endpoints consumed by the mobile app
- **User registration and lookup** for app users, alongside Laravel's built-in web auth

## Stack

- PHP 7.2+ and Laravel 7
- MySQL
- Yajra DataTables, Laravel UI (Bootstrap 4, Vue 2), Laravel Mix
- Heroku-ready via `Procfile`

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# set the DB_* values in .env, then:
php artisan migrate --seed
php artisan storage:link
npm install && npm run dev
php artisan serve
```

The seeder creates an admin account, `john_smith@gmail.com` with password `password`. Change it before deploying anywhere public.

## Mobile app integration

The Android app calls the JSON endpoints under `products`, `genres`, `appointments`, `cartList`, `favorites`, `recommendation`, and `user`. It expects the backend at `http://<host>/BookBasementApp/public/`, so either serve the app from that path or update `Constants/URL.java` in the mobile project.

## Project layout

- `app/Http/Controllers` request handlers
- `app/Repository` and `app/Traits` data access and shared query logic
- `database/migrations` and `database/seeds` schema and seed data
- `resources/views/bookbasement` admin dashboard views
