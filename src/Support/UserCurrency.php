<?php

namespace Wowpack\LaravelCurrency\Support;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Wowpack\LaravelCurrency\Models\Currency;

class UserCurrency
{
    protected Authenticatable|null $user;

    protected string $current_user_type;

    public function __construct()
    {
        $this->current_user_type = Auth::getDefaultDriver();
    }

    public function setGuardName(string|null $guard = null): static
    {
        $this->current_user_type = $guard;

        return $this;
    }

    public function getGuardName(): string
    {
        return $this->current_user_type;
    }

    protected function findUser()
    {
        $this->user = Auth::guard($this->current_user_type)->user();
        return $this;
    }

    public function getCurrency(): Currency
    {
        return $this->getCurrency();
    }

    public function setCurrency(Currency $currency): bool
    {
        return true;
    }
}
