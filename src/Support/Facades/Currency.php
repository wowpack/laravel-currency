<?php

namespace Wowpack\LaravelCurrency\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Currency extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Wowpack\LaravelCurrency\Currency::class;
    }
}
