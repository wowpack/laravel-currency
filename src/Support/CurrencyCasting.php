<?php

namespace Wowpack\LaravelCurrency\Support;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Contracts\Castable;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;
use Wowpack\LaravelCurrency\Models\Currency;
use Wowpack\LaravelCurrency\Support\Facades\Currency as CurrencyFacade;

class CurrencyCasting implements Castable
{
    protected HasCurrency $model;

    protected Currency $user_currency;

    protected float|int $input;

    protected float|int $result_amount, $result_value;

    public function __construct(Model $model)
    {
        if (isset($model) && !isset($this->user_currency)) $this->model = $model;

        if (!isset($this->user_currency)) $this->user_currency = CurrencyFacade::getDefaultCurrency();
    }

    protected function calculate(): static
    {
        $attribute = $this->model->getCurrencyAttribute();
        $value = $this->model->$attribute;

        if ($this->model instanceof HasCurrency) {
            if ($this->model instanceof UseCurrencyValue) {
            } else {
            }
        } else {
        }

        return $this;
    }

    public function input($value): static
    {
        $this->input = $value;

        return $this->calculate();
    }

    public function getAmount(): float|int
    {
        if (!isset($this->result_amount)) throw new \Exception;
        else return $this->result_amount;
    }

    public function getValue(): float|int
    {
        if (!isset($this->result_value)) throw new \Exception;
        else return $this->result_value;
    }
}
