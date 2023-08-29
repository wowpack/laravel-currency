<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

abstract class Convertible
{
    abstract public function __construct(Currency $from, Currency $to);

    abstract protected function calculate(Calculable $calculator): static;

    abstract public function getResult(): array;

    abstract public function toArray(): array;

    abstract public function __serialize(): string;
}
