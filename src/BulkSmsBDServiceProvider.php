<?php

namespace RihabRahman\BulkSmsBd;

use Illuminate\Support\ServiceProvider;

class BulksmsbdServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('bulksmsbd', function () {
            return new SmsManager();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/bulksmsbd.php', 'bulksmsbd');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/bulksmsbd.php' => config_path('bulksmsbd.php'),
        ], 'bulksmsbd-config');

        $this->loadRoutesFrom(__DIR__ . '/../routes/webhook.php');
    }
}
