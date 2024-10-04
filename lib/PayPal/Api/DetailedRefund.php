<?php

namespace PayPal\Api;

class DetailedRefund extends Refund
{
    private ?string $custom = null;

    private ?Currency $refundToPayer = null;

    /** @var array<ExternalFunding> $refundToExternalFunding */
    private array $refundToExternalFunding = [];

    private ?Currency $refundFromTransactionFee = null;

    private ?Currency $refundFromReceivedAmount = null;

    private ?Currency $totalRefundedAmount = null;

    public function setCustom(string $custom): self
    {
        $this->custom = $custom;
        return $this;
    }

    public function getCustom(): ?string
    {
        return $this->custom;
    }

    public function setRefundToPayer(Currency $refundToPayer): self
    {
        $this->refundToPayer = $refundToPayer;
        return $this;
    }

    public function getRefundToPayer(): ?Currency
    {
        return $this->refundToPayer;
    }

    public function setRefundToExternalFunding(array $refundToExternalFunding): self
    {
        $this->refundToExternalFunding = $refundToExternalFunding;
        return $this;
    }

    public function setRefundFromTransactionFee(Currency $refundFromTransactionFee): self
    {
        $this->refundFromTransactionFee = $refundFromTransactionFee;
        return $this;
    }

    public function getRefundToExternalFunding(): array
    {
        return $this->refundToExternalFunding;
    }

    public function getRefundFromTransactionFee(): ?Currency
    {
        return $this->refundFromTransactionFee;
    }

    public function setRefundFromReceivedAmount(Currency $refundFromReceivedAmount): self
    {
        $this->refundFromReceivedAmount = $refundFromReceivedAmount;
        return $this;
    }

    public function getRefundFromReceivedAmount(): ?Currency
    {
        return $this->refundFromReceivedAmount;
    }

    public function setTotalRefundedAmount(Currency $totalRefundedAmount): self
    {
        $this->totalRefundedAmount = $totalRefundedAmount;
        return $this;
    }

    public function getTotalRefundedAmount(): ?Currency
    {
        return $this->totalRefundedAmount;
    }

}
