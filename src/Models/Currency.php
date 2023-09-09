<?php

namespace Wowpack\LaravelCurrency\Models;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;
use Wowpack\LaravelCurrency\Support\Traits\WithCurrency;

class Currency extends Model implements HasCurrency, UseCurrencyValue
{
    use WithCurrency;

    protected $table = 'currencies';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'short_form',
        'code',
        'symbol',
        'value',
    ];

    public static function getCurrencyAttribute(): string
    {
        return 'value';
    }
}
