<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Castable
{
    public function __construct(Model $model);

    public function input(float|int $value): static;

    public function getAmount(): int|float;

    public function getValue(): int|float;
}
