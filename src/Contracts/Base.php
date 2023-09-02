<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    function convert(Currency $from, Currency $to): Convertible;

    function create(...$data): Currency;
}
