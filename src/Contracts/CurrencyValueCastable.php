<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface CurrencyValueCastable
{
    public function getCurrencyValueCastAttributes(): array|string;
}
