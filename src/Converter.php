<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Models\Currency;

class Converter extends Convertible
{
    public function __construct(protected Currency $from, protected Currency $to)
    {
    }

    protected function calculate(Calculable $calculator): static
    {
        return $this;
    }

    public function getResult(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return [];
    }
}
