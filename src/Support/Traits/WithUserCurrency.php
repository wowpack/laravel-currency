<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithUserCurrency
{
    public function __construct()
    {
        if (!($this instanceof Authenticatable && $this instanceof UserHasCurrency)) throw new  \Wowpack\LaravelCurrency\Exceptions\UserDoesNotHaveCurrency();
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, "user", "user_has_currencies", "user_id", "currency_id");
    }

    public function setUserCurrency(Currency $currency)
    {
        $this->removeUserCurrency($currency);

        $this->currencies()->attach($currency);

        return $this;
    }

    public function removeUserCurrency(Currency|null $currency)
    {
        if (isset($currency)) return $this->currencies()->detach($currency);

        return $this->currencies()->detach();
    }

    public function getUserCurrency(): Currency
    {
        return $this->currencies()->first() ?? Currency::first();
    }
}
