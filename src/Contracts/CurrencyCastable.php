<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface CurrencyCastable
{
    public function getCurrencyCastAttributes(): array|string;
}
