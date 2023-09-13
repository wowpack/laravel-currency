<?php

namespace Wowpack\LaravelCurrency\Providers;

use Illuminate\Support\ServiceProvider;
use Wowpack\LaravelCurrency\Base;
use Wowpack\LaravelCurrency\CurrencyBase;

class CurrencyServiceProvider extends ServiceProvider
{
    private function offerPublishes()
    {
        $this->publishes([
            __DIR__.'/../../config/currency.php' => config_path('currency.php'),
        ], 'currency-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_laravel_currency_tables.stub' => database_path('migrations/2023_09_06_100930_create_laravel_currency_tables.php'),
        ], 'currency-migration');
    }

    public function register(): void
    {
        $this->app->singleton(Base::class, fn () => new CurrencyBase);

        app()->macro('currency', fn () => app(Base::class));
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole() && function_exists('config_path') && function_exists('database_path')) {
            $this->offerPublishes();
        }
    }
}
