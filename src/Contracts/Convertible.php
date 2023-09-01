<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface Convertible
{
    function __construct(Currency $from, Currency $to);

    function save(): bool;

    function getResult(): array;

    function toArray(): array;

    function __serialize(): array;
}
