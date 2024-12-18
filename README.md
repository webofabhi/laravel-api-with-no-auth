# Laravel Api Without Auth (Laravel)

This is a basic Laravel 10 API without any authentication. There is an employee table, and it performs basic operations: add employee, list employees, update employee, and delete employee.

## Features

-   Emplpoyee Listing CRUD

## Usage

#### Install composer dependencies

```
composer install
```


#### Add .env Variables

Rename the `.env.example` file to `.env` and add your database values. Change driver and port as needed.

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Run Migrations

```
php artisan migrate
```


#### Run Server

If you are using artisan to serve, run the following:

```
php artisan serve
```

Open http://localhost:8000

