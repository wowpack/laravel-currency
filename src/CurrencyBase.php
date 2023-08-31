<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

class CurrencyBase implements Base
{
    public function __construct()
    {
    }

    public function getUserCurrency($guard = null): Currency
    {
        return Currency::get();
    }

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }

    public function create(array $data): Currency
    {
        $data = collect($data);

        return Currency::with([])->firstOrCreate($data->keys()->toArray(), $data->values()->toArray());
    }
}
