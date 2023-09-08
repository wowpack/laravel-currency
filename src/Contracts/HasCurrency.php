<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface HasCurrency
{
    public function getCurrencyAttribute(): string;
}
