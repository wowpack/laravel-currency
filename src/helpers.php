<?php

use Wowpack\LaravelCurrency\CurrencyBase;

if (!function_exists("currency")) {
    /**
     * @return Wowpack\LaravelCurrency\CurrencyBase
     */
    function currency(): CurrencyBase
    {
        return app(CurrencyBase::class);
    }
}
