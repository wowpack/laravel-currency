<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Models\Currency;

class Converter extends Convertible
{
    protected Calculable $calculator;

    protected bool $computed = false;

    public function __construct(protected Currency $from, protected Currency $to)
    {
        $this->calculator = new Calculator($to);

        $this->calculate($this->calculator);
    }

    protected function calculate(Calculable $calculator): static
    {
        if ($this->computed) return $this;

        $this->calculator->input($this->from->value);

        return $this;
    }

    public function getResult(): array
    {
        return $this->calculator->getResult();
    }

    public function toArray(): array
    {
        return [
            "currency" => $this->to->toArray(),
            "result" => $this->getResult(),
        ];
    }

    public function __serialize(): string
    {
        return json_encode($this->toArray());
    }
}
