<?php

namespace Wowpack\LaravelCurrency\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Contracts\Castable;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;
use Wowpack\LaravelCurrency\Support\CurrencyCasting;

class ConvertCurrency implements CastsAttributes
{
    private function resolve(Model $model): Castable
    {
        return app()->make(CurrencyCasting::class, [$model]);
    }

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $this->resolve($model)->input($value)->getAmount();
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($model instanceof UseCurrencyValue) return $this->resolve($model)->input($value)->getValue();
        else $this->resolve($model)->input($value)->getAmount();
    }
}
