<?php

namespace Wowpack\LaravelCurrency\Providers;

use Illuminate\Support\ServiceProvider;
use Wowpack\LaravelCurrency\Base;
use Wowpack\LaravelCurrency\CurrencyBase;
use Wowpack\LaravelCurrency\Support\UserCurrency;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Base::class, fn () => new CurrencyBase);

        $this->app->singleton(UserCurrency::class, fn () => new UserCurrency);
    }

    public function boot(): void
    {
    }
}
