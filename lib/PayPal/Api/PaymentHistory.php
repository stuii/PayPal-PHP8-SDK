<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PaymentHistory extends PayPalModel
{
    /** @var array<\PayPal\Api\Payment> $payments */
    private array $payments;
    private int $count;
    private string $nextId;
    /**
     * @param array<Payment> $payments
     */
    public function setPayments(array $payments): self
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @return array<Payment>
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->getPayments()) {
            return $this->setPayments([$payment]);
        }

        return $this->setPayments(
            [...$this->getPayments(), $payment]
        );
    }

    public function removePayment(Payment $payment): self
    {
        return $this->setPayments(
            array_diff($this->getPayments(), [$payment])
        );
    }

    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setNextId(string $nextId): self
    {
        $this->nextId = $nextId;
        return $this;
    }

    public function getNextId(): string
    {
        return $this->nextId;
    }
}
