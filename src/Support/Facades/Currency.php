<?php

namespace Wowpack\LaravelCurrency\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Wowpack\LaravelCurrency\CurrencyBase;

/**
 * @method \Wowpack\LaravelCurrency\Contracts\Convertible convert(\Wowpack\LaravelCurrency\Models\Currency $from, \Wowpack\LaravelCurrency\Models\Currency $to)
 */
class Currency extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CurrencyBase::class;
    }
}
