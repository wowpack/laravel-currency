<?php

use Wowpack\LaravelCurrency\CurrencyBase;

if (! function_exists('currency')) {

    function currency(): CurrencyBase
    {
        return app()->currency();
    }
}

if (! function_exists('defaultCurrencyName')) {

    /**
     * Returns the name of default currency
     * Example: US Dollar, Indian Rupee, Bangladeshi Taka, etc.
     *
     * @return ?string
     */
    function defaultCurrencyName(): ?string
    {
        return optional(currency()->default())->name;
    }
}

if (! function_exists('defaultCurrencyCode')) {

    /**
     * Returns the code of default currency
     * Example: BDT, INR, USD, etc.
     *
     * @return ?string
     */
    function defaultCurrencyCode(): ?string
    {
        return optional(currency()->default())->code;
    }
}

if (! function_exists('defaultCurrencySymbol')) {

    /**
     * Returns the symbol of default currency
     * Example: $, Rs, etc.
     *
     * @return ?string
     */
    function defaultCurrencySymbol(): ?string
    {
        return optional(currency()->default())->symbol;
    }
}
