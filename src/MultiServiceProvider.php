<?php

namespace jumpitt\passport;

use Illuminate\Support\ServiceProvider;
use File;

class MultiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/auth.php' => config_path('auth.php'),
            __DIR__.'/config/AuthServiceProvider.php' => app_path('Providers/AuthServiceProvider.php'),
            __DIR__.'/models' => app_path(),
            __DIR__.'/middleware' => app_path('Http/Middleware'),
            __DIR__.'/migrations' => database_path('migrations'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $auth = fopen(config_path('auth.php'), "w");
        if($auth == True) {
            $bytesWritten = File::append(config_path('auth.php'), 
                File::get(__DIR__.'/config/auth.php'));
        }

        $authProvider = fopen(app_path('Providers/AuthServiceProvider.php'), "w");
        if($authProvider == True) {
            $bytesWritten2 = File::append(app_path('Providers/AuthServiceProvider.php'), 
                File::get(__DIR__.'/config/AuthServiceProvider.php'));
        }
    }
}