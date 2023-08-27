<?php

namespace Wowpack\LaravelCurrency\Models;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;

class Currency extends Model implements HasCurrency, UseCurrencyValue
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
