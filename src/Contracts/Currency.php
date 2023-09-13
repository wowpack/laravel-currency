<?php

namespace Wowpack\LaravelCurrency\Contracts;

interface Currency
{
    public function getValueAttribute(): string;
}
