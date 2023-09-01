<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithCurrency
{
    protected string $model_type;

    public function __construct()
    {
        if (!($this instanceof HasCurrency)) throw new \Wowpack\LaravelCurrency\Exceptions\ModelDoesNotHaveCurrency();

        $this->model_type = static::class;
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, "model", "model_has_currencies", "model_id", "currency_id");
    }

    public function assignCurrency(Currency $currency)
    {
    }

    public function revokeCurrency(Currency $currency)
    {
    }

    public function getCurrency(Currency $currency)
    {
        return $this->model_type;
    }
}
