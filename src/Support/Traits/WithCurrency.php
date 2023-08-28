<?php

namespace Wowpack\LaravelCurrency\Support\Traits;

use Wowpack\LaravelCurrency\Models\Currency;

trait WithCurrency
{
    protected string $model_type;

    public function __construct()
    {
        $this->model_type = static::class;
    }

    public function assignCurrency(Currency $currency)
    {
    }

    public function revokeCurrency(Currency $currency)
    {
    }

    public function getCurrency(Currency $currency)
    {
        return $this->model_type;
    }
}
