<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function currencies() : BelongsToMany
    {
        return $this->morphToMany(Currency::class, "user", "user_has_currencies", "user_id", "currency_id");
    }

    protected function setupAuthDriver(): void
    {
        if ($this instanceof Authenticatable) {
            $this->user_guard = $this->guard ?? Auth::getDefaultDriver();
        }
    }

    public function getAuthDriver(): string
    {
        return $this->user_guard;
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
