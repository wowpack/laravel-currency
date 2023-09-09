<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface HasCurrency
{
    public static function getCurrencyAttribute(): string;
}
