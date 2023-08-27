<?php

namespace Wowpack\LaravelCurrency\Models;

use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;

class Currency implements HasCurrency, UseCurrencyValue
{
    protected $table = "currencies";

    protected $primaryKey = "id";

    protected $fillable = [
        "name",
        "code",
        "symbol",
        "value",
    ];

    public function getCurrencyValueColumn(): string
    {
        return "value";
    }
}
