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
        if ($this->app->runningInConsole()) 
        {    
            # Publish stubs
            $this->publishes([
                __DIR__.'/stubs/request.stub' => base_path('stubs'),
            ], 'stubs');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('sanitizer', function ($app) {
            return new Factory;
        });
    }
}
