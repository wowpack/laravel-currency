<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Calculable
{
    public function __construct(Currency $currency);

    public function input(int|float|null $value): static;

    public function amount(int|float|null $value): static;

    public function getValue(): int|float;

    public function getAmount(): int|float;

    public function save(): bool;

    public function getResult(): array;

    public function toArray(): array;

    public function __serialize(): array;
}
