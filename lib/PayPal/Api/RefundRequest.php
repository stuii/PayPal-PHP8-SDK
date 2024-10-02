<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class RefundRequest extends PayPalModel
{
    private ?Amount $amount = null;
    private ?string $description = null;
    private ?string $refundSource = null;
    private ?string $reason = null;
    private ?string $invoiceNumber = null;
    private bool $refundAdvice = false;

    public function setAmount(Amount $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setRefundSource(string $refundSource): self
    {
        $this->refundSource = $refundSource;
        return $this;
    }

    public function getRefundSource(): ?string
    {
        return $this->refundSource;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setRefundAdvice(bool $refundAdvice): self
    {
        $this->refundAdvice = $refundAdvice;
        return $this;
    }

    public function getRefundAdvice(): bool
    {
        return $this->refundAdvice;
    }
}
