<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    public function guard(?string $name): static;

    public function convert(Currency $from, Currency $to): Convertible;

    public function create(...$data): Currency;

    public function default(?string $guard): ?Currency;
}
