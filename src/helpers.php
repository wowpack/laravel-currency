<?php

use Wowpack\LaravelCurrency\CurrencyBase;

if (! function_exists('currency')) {

    function currency(): CurrencyBase
    {
        return app(CurrencyBase::class);
    }
}
