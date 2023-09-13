<?php

namespace Wowpack\LaravelCurrency\Contracts;

use Wowpack\LaravelCurrency\Models\Currency;

interface HasDefaultCurrency
{
    public function getDefaultCurrency(): ?Currency;
}
