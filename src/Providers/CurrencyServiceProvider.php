<?php

namespace Wowpack\LaravelCurrency\Providers;

use Illuminate\Support\ServiceProvider;
use Wowpack\LaravelCurrency\Base;
use Wowpack\LaravelCurrency\CurrencyBase;
use Wowpack\LaravelCurrency\Support\UserCurrency;

class CurrencyServiceProvider extends ServiceProvider
{
    private function offerPublishes()
    {
        $this->publishes([
            __DIR__ . "/../../database/migrations/create_laravel_currency_tables.php" => database_path("migrations/" . date('Y_m_d_His') . "_create_laravel_currency_tables.php"),
        ]);
    }

    public function register(): void
    {
        $this->app->bind(Base::class, fn () => new CurrencyBase);

        $this->app->singleton(UserCurrency::class, fn () => new UserCurrency);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole() && function_exists("config_path") && function_exists("database_path")) $this->offerPublishes();
    }
}
