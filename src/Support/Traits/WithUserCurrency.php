<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithUserCurrency
{
    /**
     * Guard name of the current Illuminate\Contracts\Auth\Authenticatable
     * @var string
     */
    protected string $user_guard;

    public function __construct()
    {
        if (!($this instanceof UserHasCurrency)) throw new  \Wowpack\LaravelCurrency\Exceptions\UserDoesNotHaveCurrency();

        $this->setupAuthDriver();
    }

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
