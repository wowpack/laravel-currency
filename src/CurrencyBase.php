<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Base;
use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Models\Currency;
use Wowpack\LaravelCurrency\Support\UserCurrency;

class CurrencyBase implements Base
{
    protected UserCurrency $userCurrency;

    public function __construct()
    {
        $this->userCurrency = app(UserCurrency::class);
    }

    public function getUserCurrency($guard = null): Currency
    {
        return Currency::get();
    }

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }

    public function create(...$data): Currency
    {
        $data = collect($data);

        return Currency::with([])->where($data->only(["name", "code"]))->firstOr("*", function () use ($data) {
            $currency = new Currency();
            $currency->name = $data->name;
            $currency->short_name = $data->short_name;
            $currency->code = $data->code;
            $currency->symbol = $data->symbol;
            $currency->value = $data->amount;
            $currency->save();
            return $currency;
        });
    }

    public function guard(string|null $name = null): static
    {
        $this->userCurrency->setGuardName($name);

        return $this;
    }

    public function currentGuard(): string
    {
        return $this->userCurrency->getGuardName();
    }
}
