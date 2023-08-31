<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    function getUserCurrency(string $guard): Currency;

    function convert(Currency $from, Currency $to): Convertible;

    function create(array $data): Currency;
}
