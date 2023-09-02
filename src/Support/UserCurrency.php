<?php

namespace Wowpack\LaravelCurrency\Support;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Models\Currency;

class UserCurrency
{
    protected string $guard;

    protected Authenticatable|null $user;

    public function guard(string|null $name): static
    {
        if (Auth::guard($name ?? Auth::getDefaultDriver())->check()) {
            $this->guard = $name;
            $this->user = Auth::guard($this->guard)->user();
        }
        return $this;
    }

    public function currency(): Currency|null
    {
        return optional($this->user)->getCurrency();
    }
}
