<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface CastableCurrencyValue
{
    public function getCurrencyCastAttributes(): array|string;
}
