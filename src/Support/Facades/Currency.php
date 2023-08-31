<?php

namespace Wowpack\LaravelCurrency\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Wowpack\LaravelCurrency\Base;

/**
 * @abstract \Wowpack\LaravelCurrency\Base
 */
class Currency extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Base::class;
    }
}
