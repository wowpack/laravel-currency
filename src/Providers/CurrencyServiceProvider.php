<?php

use Illuminate\Support\ServiceProvider;
use Wowpack\LaravelCurrency\Currency;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Currency::class, fn () => new Currency);
    }

    public function boot(): void
    {
    }
}
