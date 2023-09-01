<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface HasCurrency
{
    function getCurrencyAttribute(): string;
}
