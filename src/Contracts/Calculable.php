<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Calculable
{
    function __construct(Currency $currency);

    function input(int|float|null $value): static;

    function amount(int|float|null $value): static;

    function getValue(): int|float;

    function getAmount(): int|float;

    function save(): bool;

    function getResult(): array;

    function toArray(): array;

    function __serialize(): string;
}
