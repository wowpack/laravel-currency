<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Castable
{
    function __construct(Model $model);

    function input(float|int $value): static;

    function getAmount(): int|float;

    function getValue(): int|float;
}
