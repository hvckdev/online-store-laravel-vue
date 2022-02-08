
# Web shop

Simple web shop application with admin panel.


## Features

- Authorization / Registration
- Admin panel with admin role
- Create categories for items
- Easy order main page
- View orders page

## Dependencies
- PHP 7.3-8.0
- composer

## Installation

To install project configure env file and run commands.

```bash
  composer install
  php artisan migrate
  php artisan db:seed
```

Also u can give and take admin role for anyone by running command

```bash
  php artisan make:admin {user id}
  php artisan delete:admin {user id}
```
    
