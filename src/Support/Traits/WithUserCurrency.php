<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithUserCurrency
{
    /**
     * Guard name of the current @abstract Illuminate\Contracts\Auth\Authenticatable
     * @var string
     */
    protected string $user_guard;

    /**
     * @uses static::setupAuthDriver()
     */
    public function __construct()
    {
        $this->getUser();
    }

    /**
     * @uses Illuminate\Support\Facades\Auth::getDefaultDriver()
     * @property-read string $guard
     * @property-write string $user_guard
     * @return void
     */
    protected function setupAuthDriver(): void
    {
        if ($this instanceof Authenticatable) {
            $this->user_guard = $this->guard ?? Auth::getDefaultDriver();
        }
    }

    public function setUserCurrency(Currency $currency): bool
    {
        return true;
    }

    public function removeUserCurrency(Currency $currency): bool
    {
        return true;
    }

    public function getUserCurrency(): Currency
    {
        return Currency::first();
    }
}