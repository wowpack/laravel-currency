<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Models\Currency;

abstract class Calculable
{
    abstract public function __construct(Currency $currency);

    abstract protected function calculate(): static;

    abstract public function input(int|float|null $value): static;

    abstract public function amount(int|float|null $value): static;

    abstract public function getValue(): int|float;

    abstract public function getAmount(): int|float;

    abstract public function getResult(): array;

    abstract public function toArray(): array;

    abstract public function __serialize(): string;
}
