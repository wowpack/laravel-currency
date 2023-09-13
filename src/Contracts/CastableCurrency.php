<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface CastableCurrency
{
    public function getCurrencyCastAttributes(): array|string;
}
