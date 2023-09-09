<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Base;
use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;

class CurrencyBase implements Base
{
    protected ?Currency $currency;

    public function __construct()
    {
        $this->currency = Currency::first();
    }

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }

    public function create(...$data): Currency
    {
        return Currency::create($data);
    }

    public function setDefault(Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function default(): ?Currency
    {
        return $this->currency;
    }
}
