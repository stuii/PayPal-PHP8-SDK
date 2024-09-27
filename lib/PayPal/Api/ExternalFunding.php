<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class ExternalFunding extends PayPalModel
{
    private string $referenceId;

    private string $code;

    private string $fundingAccountId;

    private string $displayText;

    private Amount $amount;

    private string $fundingInstruction;

    public function setReferenceId(string $referenceId): ExternalFunding
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setFundingAccountId(string $fundingAccountId): self
    {
        $this->fundingAccountId = $fundingAccountId;
        return $this;
    }

    public function getFundingAccountId(): string
    {
        return $this->fundingAccountId;
    }

    public function setDisplayText(string $displayText): self
    {
        $this->displayText = $displayText;
        return $this;
    }

    public function getDisplayText(): string
    {
        return $this->displayText;
    }

    public function setAmount(Amount $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): Amount
    {
        return $this->amount;
    }

    public function setFundingInstruction(string $fundingInstruction): self
    {
        $this->fundingInstruction = $fundingInstruction;
        return $this;
    }

    public function getFundingInstruction(): string
    {
        return $this->fundingInstruction;
    }
}
