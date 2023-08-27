<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface UseCurrency
{
    public function getCurrencyColumn(): string;
}
