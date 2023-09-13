<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface HasCurrencyForeignKey
{
    public function getCurrencyForeignAttribute(): string;
}
