<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class RelatedResources extends PayPalModel
{
    private ?Sale $sale = null;
    private ?Authorization $authorization = null;
    private ?Order $order = null;
    private ?Capture $capture = null;
    private ?Refund $refund = null;

    public function setSale(Sale $sale): self
    {
        $this->sale = $sale;
        return $this;
    }

    public function getSale(): ?Sale
    {
        return $this->sale;
    }

    public function setAuthorization(Authorization $authorization): self
    {
        $this->authorization = $authorization;
        return $this;
    }

    public function getAuthorization(): ?Authorization
    {
        return $this->authorization;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setCapture(Capture $capture): self
    {
        $this->capture = $capture;
        return $this;
    }

    public function getCapture(): ?Capture
    {
        return $this->capture;
    }

    public function setRefund(Refund $refund): self
    {
        $this->refund = $refund;
        return $this;
    }

    public function getRefund(): ?Refund
    {
        return $this->refund;
    }

}
