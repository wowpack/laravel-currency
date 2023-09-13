<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Wowpack\LaravelCurrency\Casts\ConvertCurrency;
use Wowpack\LaravelCurrency\Contracts\CurrencyCastable;
use Wowpack\LaravelCurrency\Contracts\CurrencyValueCastable;
use Wowpack\LaravelCurrency\Contracts\HasCurrencyForeignKey;
use Wowpack\LaravelCurrency\Models\Currency;

trait HasCurrency
{
    protected Collection $castables;

    protected Collection $castableAttributes;

    protected Collection $valueCastableAttributes;

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

    public function castBy(string $attr): ?string
    {
        if ($this->valueCastableAttributes->contains($attr) == true) {
            return CurrencyValueCastable::class;
        }

        if ($this->castableAttributes->contains($attr) == true) {
            return CurrencyValueCastable::class;
        }

        return null;
    }

    public function currencies(): BelongsToMany
    {
        return $this->morphToMany(Currency::class, 'model', 'model_has_currencies', 'model_id', 'currency_id');
    }

    public function attachCurrency(Currency $currency = null): ?Currency
    {
        $this->currencies()->attach($currency);

        return $currency;
    }

    public function detachCurrency(Currency $currency = null)
    {
        $this->currencies()->detach($currency);

        return $this->currencies()->get();
    }

    public function setDefaultCurrency(Currency $currency): Currency
    {
        $this->currencies()->detach();

        return $this->attachCurrency($currency);
    }

    public function getDefaultCurrency(): ?Currency
    {
        if ($this instanceof HasCurrencyForeignKey) {
            return $this->currencies()->where('id', $this->getAttribute($this->getCurrencyForeignAttribute()))->first();
        }

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
