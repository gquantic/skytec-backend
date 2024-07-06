<?php

namespace App\Providers;

use App\Repositories\ConfigRepository;
use App\Services\AppConfigService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ConfigRepository::class, function ($app) {
            return new ConfigRepository();
        });

        $this->app->singleton(AppConfigService::class, function ($app) {
            return new AppConfigService($app->make(ConfigRepository::class));
        });
    }
}
