<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Casts\ConvertCurrency;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithCurrency
{
    public function __construct()
    {
        if (!($this instanceof HasCurrency)) throw new \Wowpack\LaravelCurrency\Exceptions\ModelDoesNotHaveCurrency();

        $this->casts = collect($this->casts)->put($this->getCurrencyAttribute(), ConvertCurrency::class);
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, "model", "model_has_currencies", "model_id", "currency_id");
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
