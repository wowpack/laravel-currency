<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Convertible
{
    public function __construct(Currency $from, Currency $to);

    public function amount(float|int $amount): static;

    public function save(): bool;

    public function getResult(): array;

    public function toArray(): array;

    public function __serialize(): array;
}
