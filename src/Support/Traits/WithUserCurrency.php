<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

trait WithUserCurrency
{
    protected static array $implements;

    protected static function boot(): void
    {
        static::bootUserCurrencyParent();
    }

    protected static function bootUserCurrencyParent(): void
    {
        parent::boot();

        static::$implements = class_implements(static::class);

        if (! (isset(static::$implements[Authenticatable::class]) && isset(static::$implements[UserHasCurrency::class]))) {
            throw new \Wowpack\LaravelCurrency\Exceptions\UserDoesNotHaveCurrency();
        }
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, 'user', 'user_has_currencies', 'user_id', 'currency_id');
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
}
