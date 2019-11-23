# Simple Order Manager
A simple order Manager with Laravel, this is just a exercise test :) 

## Requirements
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* [Composer](https://getcomposer.org/) dependency manager

## Installation
#### 1. Clone the repo
To install the project you should take a clone from the repository in your local with below command:
```
git clone git@github.com:mostafasoufi/simple-order-management.git
```

Then go to project with `cd`
```
cd simple-order-management
```

#### 2. Install packages & dependencies
Then try to install all packages with the composer:
```
composer install
```

#### 3. Configuration
All of the configuration options for the Laravel framework are stored in the .env file. take a copy from `.env.example` to `.env`.
```
cp .env.example .env
```
You should also configure your local environment in this file.

#### 4. Generate secret key
This will update your `.env` file
```
php artisan key:generate
```

#### 5. Serving Your Application
To serve your project locally, you can use the built-in PHP development server:
```
php -S localhost:8000 -t public
```

#### 6. Running Migrations
To run all of your outstanding migrations, execute the migrate Artisan command:
```
php artisan migrate
```

#### 7. Running Seeders
To import sample data to database, execute the seed Artisan command:
```
php artisan db:seed
```

# Unit Test
```
vendor\bin\phpunit
```
