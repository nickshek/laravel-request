# laravel-request
A simple package to log all the requests in a database for Laravel 5.

Inspired by [django-request](https://github.com/django-request/django-request)

**The project is still under development.**


# Install
You can install the package via composer:

```bash
composer require nickshek/laravel-request:dev-master
```

Install service provider
```php
// config/app.php
'providers' => [
    ...
    LaravelRequest\LaravelRequestProvider::class,
];
```

