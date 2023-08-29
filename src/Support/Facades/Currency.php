<?php

namespace Wowpack\LaravelCurrency\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Wowpack\LaravelCurrency\CurrencyBase;

class Currency extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CurrencyBase::class;
    }
}
