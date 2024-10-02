<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class VerifyWebhookSignatureResponse extends PayPalModel
{
    private ?string $verificationStatus = null;

    public function setVerificationStatus(string $verificationStatus): self
    {
        $this->verificationStatus = $verificationStatus;
        return $this;
    }

    public function getVerificationStatus(): ?string
    {
        return $this->verificationStatus;
    }
}
