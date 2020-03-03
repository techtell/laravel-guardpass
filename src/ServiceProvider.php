<?php

namespace Sivanov\LaravelGuardPass;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';

        app('router')->aliasMiddleware('filters', \Sivanov\LaravelGuardPass\Http\MiddleWare\Filters::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__. ' /config/guardpass.php', 'guardpass'
        );

        $this->loadViewsFrom(__DIR__ . '/views', 'guardpass');
    }
}
