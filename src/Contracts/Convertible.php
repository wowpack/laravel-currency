<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

abstract class Convertible
{
    abstract function __construct(Currency $from, Currency $to);

    abstract protected function calculate(Calculable $calculator): static;

    abstract function save(): bool;

    abstract function getResult(): array;

    abstract function toArray(): array;

    abstract function __serialize(): string;
}
