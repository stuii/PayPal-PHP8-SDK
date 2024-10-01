<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PaymentOptions extends PayPalModel
{
    private ?string $allowedPaymentMethod = null;

    public function setAllowedPaymentMethod(string $allowedPaymentMethod): self
    {
        $this->allowedPaymentMethod = $allowedPaymentMethod;
        return $this;
    }

    public function getAllowedPaymentMethod(): ?string
    {
        return $this->allowedPaymentMethod;
    }
}
