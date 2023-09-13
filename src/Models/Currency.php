<?php

namespace Wowpack\LaravelCurrency\Models;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Contracts\CastableCurrencyValue;
use Wowpack\LaravelCurrency\Support\Traits\HasCurrency;

class Currency extends Model implements \Wowpack\LaravelCurrency\Contracts\Currency, CastableCurrencyValue
{
    use HasCurrency;

    protected $table = 'currencies';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'value',
    ];

    public function getValueAttribute(): string
    {
        return 'value';
    }

    public function getCurrencyValueCastAttributes(): array|string
    {
        return 'value';
    }
}
