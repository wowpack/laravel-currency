<?php

namespace Wowpack\LaravelCurrency\Support;

use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Calculator;
use Wowpack\LaravelCurrency\Contracts\Castable;
use Wowpack\LaravelCurrency\Contracts\HasCurrency;
use Wowpack\LaravelCurrency\Contracts\UseCurrencyValue;
use Wowpack\LaravelCurrency\Converter;
use Wowpack\LaravelCurrency\Models\Currency;
use Wowpack\LaravelCurrency\Support\Facades\Currency as CurrencyFacade;

class CurrencyCasting implements Castable
{
    protected $model;

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
        if ($this->model instanceof HasCurrency) {
            $calculator = new Calculator($this->user_currency);
            if ($this->model instanceof UseCurrencyValue) {
                $calculator->input($this->input);
            } else {
                $calculator->input((new Calculator($this->model->currency()))->input($this->input)->getValue());
            }
            $this->result_amount = $calculator->getAmount();
            $this->result_value = $calculator->getValue();
        } else {
            throw new \Exception;
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
