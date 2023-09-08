<?php

namespace Wowpack\LaravelCurrency;

use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Contracts\Base;
use Wowpack\LaravelCurrency\Contracts\Convertible;
use Wowpack\LaravelCurrency\Contracts\UserHasCurrency;
use Wowpack\LaravelCurrency\Models\Currency;

class CurrencyBase implements Base
{
    protected Currency $defaultCurrency;

    public function convert(Currency $from, Currency $to): Convertible
    {
        return new Converter($from, $to);
    }

    public function create(...$data): Currency
    {
        return Currency::create($data);
    }

    public function getDefaultCurrency(string $guard = null): Currency
    {
        if (! isset($this->defaultCurrency)) {
            $this->defaultCurrency = Currency::first();
            $auth = Auth::guard($guard);

            if (isset($guard) && $auth->check()) {
                $this->defaultCurrency = $auth->user()->getCurrency() ?? $this->defaultCurrency;
            } else {
                foreach (array_keys(config('auth.guards')) as $name) {
                    $auth = Auth::guard($name);

                    if ($auth->check() && $auth->user() instanceof UserHasCurrency) {
                        $this->defaultCurrency = $auth->user()->getCurrency() ?? $this->defaultCurrency;
                        break;
                    }
                }
            }
        }

        return $this->defaultCurrency;
    }
}
