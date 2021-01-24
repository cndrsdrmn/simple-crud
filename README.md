# Submission Tech Test (IT Engineer Bridgenote)

## About

This simple CRUD for resolve submission tech test (IT Engineer Bridgenote)

## Setup Local Environment
- Clone this repo
- Run `composer install` on project root
- After that run a command `cp .env.example .env`
- Set all required settings in `.env` file following the variables
    - `APP_KEY` or use command `php artisan key:generate`
    - `APP_URL` _(optional)_
    - `DB_CONNECTION`
    - `DB_HOST`
    - `DB_PORT`
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`
    - `JWT_SECRET` or use command `php artisan jwt:secret`
- After that run a command `php artisan migrate --seed`
- Running the service using local configuration `php artisan serve` or you can set up webserver

## Feature
- **Login**
- **Logout**
- **API Simple CRUD**

## Testing

Run command on project root `php vendor/bin/phpunit` or `php artisan test` for testing Feature

Run command on project root `php artisan dusk` for testing Browser

## API Documentation

You can access [http://localhost:8000/api/documentations]() to see API Documentation
