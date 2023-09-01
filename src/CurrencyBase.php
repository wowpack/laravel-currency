<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Base;
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

    public function create(...$data): Currency
    {
        $data = collect($data);

        return Currency::with([])->where($data->only(["name", "code"]))->firstOr("*", function () use ($data) {
            $currency = new Currency();
            $currency->name = $data->name;
            $currency->short_name = $data->short_name;
            $currency->code = $data->code;
            $currency->symbol = $data->symbol;
            $currency->value = $data->amount;
            $currency->save();
            return $currency;
        });
    }
}
