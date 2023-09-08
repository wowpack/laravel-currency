<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Calculable;
use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

class Converter implements Convertible
{
    protected Calculable $calculator;

    protected float|int $amount;

    protected bool $computed = false;

    public function __construct(protected Currency $from, protected Currency $to)
    {
        $this->calculator = new Calculator($to);
        $this->calculate();
    }

    protected function calculate(): static
    {
        if (! $this->computed) {
            $value = $this->from->getRawOriginal(
                $this->from->getCurrencyAttribute()
            );
            $this->calculator->input($value * $this->amount);
        }

        return $this;
    }

    public function amount(float|int $amount = 1): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function save(): bool
    {
        $this->to->setRawAttributes([
            $this->to->getCurrencyAttribute() => $this->calculator->getValue(),
        ], true);

        return $this->to->save();
    }

    public function getResult(): array
    {
        return $this->calculator->getResult();
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->to->toArray(),
            'result' => $this->getResult(),
        ];
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }
}
