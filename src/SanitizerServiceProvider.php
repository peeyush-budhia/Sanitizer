<?php

namespace Peeyush\Sanitizer;

use Illuminate\Support\ServiceProvider;

class SanitizerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sanitizer');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'sanitizer');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) 
        {
            # Publish stubs
            $this->publishes([
                __DIR__.'/../stubs' => base_path('stubs'),
            ], 'stubs');

            # Publish Unit tests
            $this->publishes([
                __DIR__.'/../tests/Unit' => base_path('tests/Unit'),
            ], 'tests');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('sanitizer', function () {
            return new Factory;
        });
    }
}
