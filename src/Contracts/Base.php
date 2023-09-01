<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

interface Base
{
    function getUserCurrency(string $guard): Currency;

    function convert(Currency $from, Currency $to): Convertible;

    function create(...$data): Currency;

    function guard(string|null $name = null): static;

    function currentGuard(): string;
}
