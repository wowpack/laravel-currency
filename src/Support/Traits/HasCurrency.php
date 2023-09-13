<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Wowpack\LaravelCurrency\Casts\ConvertCurrency;
use Wowpack\LaravelCurrency\Contracts\CurrencyCastable;
use Wowpack\LaravelCurrency\Contracts\CurrencyValueCastable;
use Wowpack\LaravelCurrency\Models\Currency;

trait HasCurrency
{
    protected Collection $castables, $castableAttributes, $valueCastableAttributes;

    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();

        $this->initializeTraits();

        $this->syncOriginal();

        $this->fill($attributes);

        if ($this instanceof CurrencyCastable || $this instanceof CurrencyValueCastable) {
            $this->mergeCurrencyCasts();
        }
    }

    protected static function boot(): void
    {
        static::bootCurrencyParent();
    }

    protected static function bootCurrencyParent(): void
    {
        parent::boot();
    }

    private function parseCastableAttributes(array|string $data): array
    {
        if (is_string($data)) {
            $data = str($data)->explode(',');
        }

        return $data;
    }

    protected function mergeCurrencyCasts(): void
    {
        $this->castables = new Collection;
        $this->castableAttributes = new Collection;
        $this->valueCastableAttributes = new Collection;

        if ($this instanceof CurrencyCastable) {
            $this->castableAttributes = collect($this->getCurrencyCastAttributes());
        }

        if ($this instanceof CurrencyValueCastable) {
            $this->valueCastableAttributes = collect($this->getCurrencyValueCastAttributes());
        }

        $this->castables = $this->castables->merge($this->castableAttributes)->merge($this->valueCastableAttributes)->unique();

        $this->mergeCasts($this->castables->map(fn ($value) => ['key' => $value, 'value' => ConvertCurrency::class])
            ->pluck('value', 'key')->toArray());
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
