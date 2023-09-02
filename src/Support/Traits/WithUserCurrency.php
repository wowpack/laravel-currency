<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;
use Wowpack\LaravelCurrency\Support\Facades\Currency as CurrencyFacade;

trait WithUserCurrency
{
    public function __construct()
    {
        if (!($this instanceof Authenticatable && $this instanceof UserHasCurrency)) {
            throw new  \Wowpack\LaravelCurrency\Exceptions\UserDoesNotHaveCurrency();
        } else {
            CurrencyFacade::user($this->guard);
        }
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, "user", "user_has_currencies", "user_id", "currency_id");
    }

    public function setCurrency(Currency $currency)
    {
        if ($this->getCurrency()) $this->removeUserCurrency();

        $this->currencies()->attach($currency);

        return $this;
    }

    public function removeCurrency(Currency|null $currency = null)
    {
        if (isset($currency)) return $this->currencies()->detach($currency);

        return $this->currencies()->detach();
    }

    public function getCurrency(): Currency|null
    {
        return $this->currencies()->first();
    }
}
