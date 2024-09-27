<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class Payee extends PayPalModel
{
    private string $email;

    private string $merchantId;

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setMerchantId(string $merchantId): self
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }
}
