<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class Payer extends PayPalModel
{
    private string $paymentMethod;

    private ?string $status = null;

    /** @var array<\PayPal\Api\FundingInstrument> */
    private array $fundingInstruments = [];

    private PayerInfo $payerInfo;

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param array<\PayPal\Api\FundingInstrument> $fundingInstruments
     */
    public function setFundingInstruments(array $fundingInstruments): self
    {
        $this->fundingInstruments = $fundingInstruments;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\FundingInstrument>
     */
    public function getFundingInstruments(): array
    {
        return $this->fundingInstruments;
    }

    public function addFundingInstrument(FundingInstrument $fundingInstrument): self
    {
        if (!$this->getFundingInstruments()) {
            return $this->setFundingInstruments([$fundingInstrument]);
        }

        return $this->setFundingInstruments(
            [...$this->getFundingInstruments(), $fundingInstrument]
        );
    }

    public function removeFundingInstrument(FundingInstrument $fundingInstrument): self
    {
        return $this->setFundingInstruments(
            array_diff($this->getFundingInstruments(), [$fundingInstrument])
        );
    }

    public function setExternalSelectedFundingInstrumentType(string $externalSelectedFundingInstrumentType): self
    {
        $this->externalSelectedFundingInstrumentType = $externalSelectedFundingInstrumentType;
        return $this;
    }

    public function getExternalSelectedFundingInstrumentType(): string
    {
        return $this->externalSelectedFundingInstrumentType;
    }

    public function setPayerInfo(PayerInfo $payerInfo): self
    {
        $this->payerInfo = $payerInfo;
        return $this;
    }

    public function getPayerInfo(): PayerInfo
    {
        return $this->payerInfo;
    }

}
