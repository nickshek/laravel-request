# laravel-request

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nickshek/laravel-request.svg?style=flat-square)](https://packagist.org/packages/nickshek/laravel-request)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/nickshek/laravel-request/master.svg?style=flat-square)](https://travis-ci.org/nickshek/laravel-request)
[![Quality Score](https://img.shields.io/scrutinizer/g/nickshek/laravel-request.svg?style=flat-square)](https://scrutinizer-ci.com/g/nickshek/laravel-request)

A simple package to log all the requests in a database for Laravel 5.

Inspired by [django-request](https://github.com/django-request/django-request)

> Note: This package is still very alpha!

# Install
You can install the package via composer:

```bash
composer require nickshek/laravel-request
```

Install service provider
```php
// config/app.php
'providers' => [
    ...
    LaravelRequest\LaravelRequestServiceProvider::class,
];
```

publish migrations and config file

```bash
php artisan vendor:publish --provider="LaravelRequest\LaravelRequestServiceProvider"
```
Afterwards you can edit the file ```config/laravel-request.php``` to suit your needs.

Run migration to create required tables

```bash
php artisan migrate
```

By default, the middleware ```\LaravelRequest\Middleware\LogAfterRequest::class``` enables logging on all pages. You'll probably want to inherit your own class containing you application's logging rule handler.

```php
namespace App\Http\Middleware;
// app/Http/Middleware/LogAfterRequestExceptAdmin.php
use LaravelRequest\Middleware\LogAfterRequest;

class LogAfterRequestExceptAdmin extends LogAfterRequest
{
  /**
  * @return bool
  */
  protected function shouldLogRequest($request, $response)
  {
    return $request->segment(1) !== 'admin';
  }
}
```
Next, simply register the newly created class in your middleware stack.

```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
        \App\Http\Middleware\LogAfterRequestExceptAdmin::class,
    ];

    // ...
}
```

That's it!

# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
