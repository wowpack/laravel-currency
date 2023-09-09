<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    public function convert(Currency $from, Currency $to): Convertible;

    public function create(...$data): Currency;

    public function setDefault(Currency $currency): static;

    public function default(): ?Currency;
}
