# laravel-request

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nickshek/laravel-request.svg?style=flat-square)](https://packagist.org/packages/nickshek/laravel-request)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/nickshek/laravel-request/master.svg?style=flat-square)](https://travis-ci.org/nickshek/laravel-request)
[![Quality Score](https://img.shields.io/scrutinizer/g/nickshek/laravel-request.svg?style=flat-square)](https://scrutinizer-ci.com/g/nickshek/laravel-request)

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

publish migrations and config file

```bash
php artisan vendor:publish --provider="LaravelRequest\LaravelRequestProvider"
```
Afterwards you can edit the file ```config/laravel-request.php``` to suit your needs.

Run migration to create required tables

```bash
php artisan migrate
```

Finally, simply register the newly created class in your middleware stack.
```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        \LaravelRequest\Middleware\LogAfterRequest::class,
    ];

    // ...
}
```

That's it!

# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
