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
