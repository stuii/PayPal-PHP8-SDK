<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class CreditCardToken extends PayPalModel
{
    private string $creditCardId;

    private string $payerId;

    private string $last4;

    private string $type;

    private int $expireMonth;

    private int $expireYear;


    public function setCreditCardId(string $creditCardId): self
    {
        $this->creditCardId = $creditCardId;
        return $this;
    }

    public function getCreditCardId(): string
    {
        return $this->creditCardId;
    }

    public function setPayerId(string $payerId): self
    {
        $this->payerId = $payerId;
        return $this;
    }

    public function getPayerId(): string
    {
        return $this->payerId;
    }

    public function setLast4(string $last4): self
    {
        $this->last4 = $last4;
        return $this;
    }

    public function getLast4(): string
    {
        return $this->last4;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setExpireMonth(int $expireMonth): self
    {
        $this->expireMonth = $expireMonth;
        return $this;
    }

    public function getExpireMonth(): int
    {
        return $this->expireMonth;
    }

    public function setExpireYear(int $expireYear): self
    {
        $this->expireYear = $expireYear;
        return $this;
    }

    public function getExpireYear(): int
    {
        return $this->expireYear;
    }

}
