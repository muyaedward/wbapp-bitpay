<?php

namespace Muyaedward\WbappBitpay;

use Illuminate\Support\ServiceProvider;
use Muyaedward\WbappBitpay\Commands\CreateKeypair;

class WbappBitpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/wbapp-bitpay.php' => config_path('wbapp-bitpay.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/wbapp-bitpay.php', 'wbapp-bitpay');
        $this->app->bind('command.wbapp-bitpay:createkeypair', CreateKeypair::class);
        $this->commands([
            'command.wbapp-bitpay:createkeypair',
        ]);
    }
}
