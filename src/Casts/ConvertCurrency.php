<?php

namespace Wowpack\LaravelCurrency\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Wowpack\LaravelCurrency\Calculator;
use Wowpack\LaravelCurrency\Contracts\CurrencyCastable;
use Wowpack\LaravelCurrency\Contracts\CurrencyValueCastable;
use Wowpack\LaravelCurrency\Converter;
use Wowpack\LaravelCurrency\Models\Currency;

class ConvertCurrency implements CastsAttributes
{
    protected ?Currency $current;

    public function __construct()
    {
        if (! $this->current = app()->currency()->default()) {
            if (app()->isProduction()) {
                abort(403, 'Default currency not found!');
            } else {
                throw new \Exception('Unable to read default currency on null!');
            }
        }
    }

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $castingBy = $model->castBy($key);

        if ($castingBy == CurrencyValueCastable::class) {
            $calculator = new Calculator($this->current);
            $calculator->input($value);

            return $calculator->getAmount();
        } elseif ($castingBy == CurrencyCastable::class) {
            $converter = new Converter($model->getCurrency(), $this->current);
            $converter->amount($value);

            return $converter->getResult()['amount'];
        }

        return $value;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $castingBy = $model->castBy($key);

        if ($castingBy == CurrencyValueCastable::class) {
            $calculator = new Calculator($this->current);
            $calculator->amount($value);

            return $calculator->getValue();
        } elseif ($castingBy == CurrencyCastable::class) {
            $converter = new Converter($this->current, $model->getCurrency());
            $converter->amount($value);

            return $converter->getResult()['amount'];
        }

        return $value;
    }
}
