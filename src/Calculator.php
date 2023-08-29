<?php

namespace Wowpack\LaravelCurrency;

class Calculator extends CalculatorInterface
{
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

    public function __serialize()
    {
        return json_encode([
            "currency" => $this->currency,
            "input" => [
                "amount" => $this->amount,
                "value" => $this->value,
            ],
            "result" => [
                "amount" => $this->getAmount(),
                "value" => $this->getValue(),
            ],
        ]);
    }
}
