<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    public function convert(Currency $from, Currency $to): Convertible;

    public function create(...$data): Currency;

    public function getDefaultCurrency(?string $guard): Currency;
}
