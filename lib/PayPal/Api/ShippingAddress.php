<?php

namespace PayPal\Api;

class ShippingAddress extends Address
{
    private string $recipientName;

    public function setRecipientName(string $recipientName): self
    {
        $this->recipientName = $recipientName;
        return $this;
    }

    public function getRecipientName(): string
    {
        return $this->recipientName;
    }
}
