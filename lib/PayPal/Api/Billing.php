<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class Billing extends PayPalModel
{
    private string $billingAgreementId;


    public function setBillingAgreementId(string $billingAgreementId): self
    {
        $this->billingAgreementId = $billingAgreementId;
        return $this;
    }

    public function getBillingAgreementId(): string
    {
        return $this->billingAgreementId;
    }

}