<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

class CurrencyBase
{
    public function __construct()
    {
    }

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }
}
