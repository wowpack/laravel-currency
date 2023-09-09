<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Casts\ConvertCurrency;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithCurrency
{
    protected static array $implements;

    protected static function boot(): void
    {
        static::bootCurrencyParent();
    }

    protected static function bootCurrencyParent(): void
    {
        parent::boot();

        static::$implements = class_implements(static::class);

        if (! isset(static::$implements[HasCurrency::class])) {
            throw new \Wowpack\LaravelCurrency\Exceptions\ModelDoesNotHaveCurrency();
        }

        static::mergeCasts([static::getCurrencyAttribute() => ConvertCurrency::class]);
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, 'model', 'model_has_currencies', 'model_id', 'currency_id');
    }

    public function setCurrency(Currency $currency)
    {
        if ($this->getCurrency()) {
            $this->removeUserCurrency();
        }

        $this->currencies()->attach($currency);

        return $this;
    }

    public function removeCurrency(Currency $currency = null)
    {
        if (isset($currency)) {
            return $this->currencies()->detach($currency);
        }

        return $this->currencies()->detach();
    }

    public function getCurrency(): ?Currency
    {
        return $this->currencies()->first();
    }

    protected static function booted()
    {
        static::bootedCurrencyParent();
    }

    protected static function bootedCurrencyParent(): void
    {
        //
    }
}
