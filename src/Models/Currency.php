<?php

namespace Wowpack\LaravelCurrency\Models;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Support\Traits\HasCurrency;

class Currency extends Model implements \Wowpack\LaravelCurrency\Contracts\Currency
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
}
