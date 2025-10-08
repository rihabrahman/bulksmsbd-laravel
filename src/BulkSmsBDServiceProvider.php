<?php

namespace RihabRahman\BulkSmsBD;

use Illuminate\Support\ServiceProvider;

class BulkSmsBDServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bulksmsbd.php', 'bulksmsbd');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/bulksmsbd.php' => config_path('bulksmsbd.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/webhook.php');
    }
}
