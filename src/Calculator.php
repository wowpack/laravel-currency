<?php

namespace Wowpack\LaravelCurrency;

use Wowpack\LaravelCurrency\Contracts\Calculable;
use Wowpack\LaravelCurrency\Models\Currency;

class Calculator implements Calculable
{
    protected int|float|null $value, $amount;

    protected int|float|null $result_value, $result_amount;

    protected bool $computed = false;

    public function __construct(protected Currency $currency)
    {
    }

    protected function calculate(): static
    {
        if ($this->computed) return $this;

        elseif (isset($this->value)) {
            $this->result_value = $this->value;
            $this->result_amount = $this->value / $this->currency->value;
        } elseif (isset($this->amount)) {
            $this->result_amount = $this->amount;
            $this->result_value = $this->amount * $this->currency->value;
        } else {
            throw new \InvalidArgumentException("No value/amount provided");
        }

        return $this;
    }

    public function input(int|float|null $value): static
    {
        if (isset($value)) {
            $this->value = $value;
            $this->amount = null;
        }

        return $this;
    }

    public function amount(int|float|null $value): static
    {
        if (isset($value)) {
            $this->amount = $value;
            $this->value = null;
        }

        return $this;
    }

    public function getValue(): int|float
    {
        return $this->calculate()->result_value;
    }

    public function getAmount(): int|float
    {
        return $this->calculate()->result_amount;
    }

    public function save(): bool
    {
        $this->currency->value = $this->getValue();
        return $this->currency->save();
    }

    public function getResult(): array
    {
        return [
            "amount" => $this->getAmount(),
            "value" => $this->getValue(),
        ];
    }

    public function toArray(): array
    {
        return [
            "currency" => $this->currency->toArray(),
            "input" => [
                "amount" => $this->amount,
                "value" => $this->value,
            ],
            "result" => $this->getResult(),
        ];
    }

    public function __serialize()
    {
        return json_encode($this->toArray());
    }
}
