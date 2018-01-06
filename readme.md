# Mojaz Back-end Developer Assignment

* [Requirements](#requirements)
* [Installation](#installation)
* [Tests](#tests)
* [API Endpoints](#apis)

## Requirements
This project built using **laravel 5.5**, so your php version must be >= **7.0**

## Installation
1. Clone the source code. `git clone https://github.com/Rochdy/mojaz.git`
2. Go to inside the project. `cd mojaz`
3. Run `composer install` to install all the dependencies.
4. Copy configrations file. `cp .env.example .env`
5. Create a new database.
6. Open .env file and set database configrations
```php
      DB_DATABASE= YOUR_DATABASE_NAME_HERE
      DB_USERNAME= YOUR_USERNAME_HERE
      DB_PASSWORD= YOUR_PASSWORD_HERE
```
7. Migrate the tables `php artisan migrate`
8. Run the project! `php artisan serve`

## Tests
All tests are placed in tests/Feature, you can run them by type in terminal:
```shell
vendor/bin/phpunit
```

## APIs
| Name | URL| Method | Required | Success Response |
|------|----|--------|----------|----------|
| Register | /api/register/ | POST | `username` `email` `password`| `code: 201` `user`|
| Login | /api/login/ | POST | `username` `password`| `code: 200` `user`|
| Show Lists | /api/list/ | POST | `api_token`| `lists[]` |
| Show List items | /api/list/{list} | POST | `api_token`| `items[]` |
| Create List | /api/list/create | POST | `api_token` `title`| `code: 201` `list` |
| Edit List | /api/list/{list}/edit | PUT | `api_token`| `code: 200` `list` |
| Delete List | /api/list/{list}/delete | DELETE | `api_token`| `code: 204`|
| Create Item | /api/list/{list}/item | POST | `api_token`| `code: 201` `list` |
| Edit Item | /api/list/{list}/item/{item}/delete | PUT | `api_token`| `code: 200` `list` |
| Delete Item | /api/list/{list}/item/{item}/delete | DELETE | `api_token`| `code: 204` |
