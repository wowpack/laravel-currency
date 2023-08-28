<?php

namespace Wowpack\LaravelCurrency;

class Calculator extends CalculatorInterface
{
    protected $computed = false;

    private function checkAndThrowException(): void
    {
    }

    protected function calculate(): static
    {
        // Run if Operations already not computed
        if (!$this->computed) {

            $this->checkAndThrowException();

            if ($this->currency->value != $this->value) {
            }

            // Make computation status true
            $this->computed = true;
        }

        return $this;
    }

    public function input($value): static
    {
        $this->value = $value;
        $this->amount = null;

        return $this;
    }

    public function amount($value): static
    {
        $this->amount = $value;
        $this->value = null;

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
}
