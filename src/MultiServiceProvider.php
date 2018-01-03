<?php

namespace jumpitt\passport;

use Illuminate\Support\ServiceProvider;

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
            __DIR__.'/models' => app_path(),
            __DIR__.'/middleware' => app_path(),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/auth.php', 'auth.guards'
        );
    }
}
