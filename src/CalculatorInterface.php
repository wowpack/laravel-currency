<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Models\Currency;

abstract class CalculatorInterface
{
    protected int|float|null $value, $amount;

    protected int|float|null $result_value, $result_amount;

    public function __construct(protected Currency $currency)
    {
    }

    abstract protected function calculate(): static;

    abstract public function input(int|float|null $value): static;

    abstract public function amount(int|float|null $value): static;

    abstract public function getValue(): int|float;

    abstract public function getAmount(): int|float;
}
