<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Casts\ConvertCurrency;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithCurrency
{
    public function __construct()
    {
        if (!($this instanceof HasCurrency)) throw new \Wowpack\LaravelCurrency\Exceptions\ModelDoesNotHaveCurrency();

        $this->casts = collect($this->casts)->put($this->getCurrencyAttribute(), ConvertCurrency::class)->toArray();
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

    protected static function booted()
    {
        static::created(function (Model $model) {
        });

        static::updating(function (Model $model) {
        });

        static::updated(function (Model $model) {
        });

        static::saving(function (Model $model) {
        });

        static::saved(function (Model $model) {
        });

        static::deleting(function (Model $model) {
        });

        static::deleted(function (Model $model) {
        });
    }
}
