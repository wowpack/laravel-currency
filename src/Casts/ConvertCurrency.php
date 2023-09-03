<?php

namespace Wowpack\LaravelCurrency\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Calculator;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;
use Wowpack\LaravelCurrency\Converter;
use Wowpack\LaravelCurrency\Models\Currency;
use Wowpack\LaravelCurrency\Support\Facades\Currency as CurrencyFacade;

class ConvertCurrency implements CastsAttributes
{
    protected Currency $current;

    public function __construct()
    {
        $this->current = CurrencyFacade::getDefaultCurrency();
    }

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($model instanceof UseCurrencyValue) {
            $calculator = app()->make(Calculator::class, [$this->current]);
            $calculator->input($value);
            return $calculator->getAmount();
        } else {
            $converter = app()->make(Converter::class, [$model->getCurrency(), $this->current]);
            $converter->amount($value);
            return $converter->getResult()["amount"];
        }
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($model instanceof UseCurrencyValue) {
            $calculator = app()->make(Calculator::class, [$this->current]);
            $calculator->amount($value);
            return $calculator->getValue();
        } else {
            $converter = app()->make(Converter::class, [$this->current, $model->getCurrency()]);
            $converter->amount($value);
            return $converter->getResult()["amount"];
        }
    }
}
