<?php

namespace PayPal\Api;

class Transaction extends TransactionBase
{
    /** @var array<\PayPal\Api\Transaction> $transactions */
    private array $transactions = [];

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
}
