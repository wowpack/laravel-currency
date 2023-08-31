<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

abstract class Calculable
{
    abstract function __construct(Currency $currency);

    abstract protected function calculate(): static;

    abstract function input(int|float|null $value): static;

    abstract function amount(int|float|null $value): static;

    abstract function getValue(): int|float;

    abstract function getAmount(): int|float;

    abstract function getResult(): array;

    abstract function toArray(): array;

    abstract function __serialize(): string;
}
