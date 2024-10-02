<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PaymentExecution extends PayPalModel
{
    private ?string $payerId = null;

    /** @var array<\PayPal\Api\Transaction> $transactions */
    private array $transactions = [];


    public function setPayerId(string $payerId): self
    {
        $this->payerId = $payerId;
        return $this;
    }

    public function getPayerId(): ?string
    {
        return $this->payerId;
    }

    /**
     * @param array<Transaction> $transactions
     */
    public function setTransactions(array $transactions): self
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @return array<Transaction>
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->getTransactions()) {
            return $this->setTransactions([$transaction]);
        }

        return $this->setTransactions(
            [...$this->getTransactions(), $transaction]
        );
    }

    public function removeTransaction(Transaction $transaction): self
    {
        return $this->setTransactions(
            array_diff($this->getTransactions(), [$transaction])
        );
    }
}
