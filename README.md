# System Requirements
* php7.4
* sqlite driver - `sudo apt install php7.4-sqlite`
* Other regular requirements to run Laravel 8.x
# Installation

To setup the project please follow the steps below

## 1. Clone the repo
```bash
git clone https://github.com/mahmudkuet11/square1-blog.git
```

## 2. Copy the env files
```bash
cp .env.example .env
cp .env.example .env.dusk.local
```

## 3. Make necessary changes to the following environment variables
File: `.env`
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=square1_blog
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

ADMIN_USER_PASSWORD="admin"
```

> Cache driver should be `redis` and redis should have been installed on host machine

## 4. Install dependencies
```bash
composer install --prefer-dist
```

## 5. Generate application key
```bash
php artisan key:generate
```

## 6. Migration and Seeding
```bash
php artisan migrate

# To create the designated admin user
php artisan db:seed --class=InitialDataSeeder

# (Optional) If you want to seed some dummy data
php artisan db:seed
```

## 7. Run the server
```bash
php artisan serve
```

>Now visit [http://localhost:8000](http://localhost:8000) to view the application

# Run Tests

## Integration test
Please make sure you have the `sqlite` driver is installed on your machine. Because the testing process uses sqlite as in memory database
```bash
php artisan test
```

## Browser test (Laravel Dusk)

Chrome and chrome-driver should have been installed on your machine. To install the proper version of chrome-driver run the following command
```bash
php artisan dusk:chrome-driver --detect

chmod -R 0755 vendor/laravel/dusk/bin/
```

Make sure you have copied the `.env.dusk.local` file mentioned in **step 2**. Also create another database and update the database related env variables  to run the dusk tests.

File: `.env.dusk.local`
```bash
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=square1_blog_test
DB_USERNAME=root
DB_PASSWORD=root
```

To run the tests
```bash
php artisan dusk
```

Here are the badges of Github Actions

![Integration Test](https://github.com/mahmudkuet11/square1-blog/actions/workflows/phpunit_ci.yml/badge.svg)

![Dusk Test](https://github.com/mahmudkuet11/square1-blog/actions/workflows/dusk_ci.yml/badge.svg)
