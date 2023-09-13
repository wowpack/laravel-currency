<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface CastableCurrencyValue
{
    public function getCurrencyValueCastAttributes(): array|string;
}
