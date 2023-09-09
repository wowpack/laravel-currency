<?php

namespace Wowpack\LaravelCurrency;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Contracts\Base;
use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

class CurrencyBase implements Base
{
    protected string $guard;

    protected Collection $user_currencies;

    protected bool $fetched_user_currencies = false;

    protected ?Currency $currency;

    public function __construct()
    {
        $this->guard = Auth::getDefaultDriver();
        $this->user_currencies = new Collection();
        $this->currency = Currency::first();
    }

    protected function activeUserDefaultCurrencies(): static
    {
        if ($this->fetched_user_currencies) {
            return $this;
        }

        $guards = array_keys(config('auth.guards'));

        foreach ($guards as $guard) {
            $auth = Auth::guard($guard);
            if ($auth->check() && $auth->user() instanceof UserHasCurrency) {
                if ($currency = optional($auth->user())->getCurrency()) {
                    $this->user_currencies->put($guard, $currency);
                }
            }
        }

        return $this;
    }

    public function guard($name = null): static
    {
        $this->guard = $name ?? $this->guard;

        return $this;
    }

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }

    public function create(...$data): Currency
    {
        return Currency::create($data);
    }

    public function default($guard = null): ?Currency
    {
        return $this->guard($guard)
            ->activeUserDefaultCurrencies()
            ->user_currencies
            ->get($this->guard, $this->currency);
    }
}
