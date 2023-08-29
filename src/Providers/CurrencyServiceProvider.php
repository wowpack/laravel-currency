<?php

use Illuminate\Support\ServiceProvider;
use Wowpack\LaravelCurrency\CurrencyBase;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CurrencyBase::class, fn () => new CurrencyBase);
    }

    public function boot(): void
    {
    }
}
