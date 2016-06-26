<?php

namespace LaravelRequest;

use Illuminate\Support\ServiceProvider;
use LaravelRequest\Middleware\LogAfterRequest;

class LaravelRequestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
           __DIR__.'/../resources/config/laravel-request.php' => config_path('laravel-request.php'),
       ], 'config');

        //
        if (!class_exists('CreateRequestsTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../resources/migrations/create_requests_table.stub' => database_path('migrations/'.$timestamp.'_create_requests_table.php'),
            ], 'migrations');
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app['router']->middleware('log_after_request', LogAfterRequest::class);
    }
}
