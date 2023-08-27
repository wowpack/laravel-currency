<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface UseCurrencyValue
{
    public function getCurrencyValueColumn(): string;
}
