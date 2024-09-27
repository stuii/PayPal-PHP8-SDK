<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class FundingInstrument extends PayPalModel
{
    private CreditCard $creditCard;

    private CreditCardToken $creditCardToken;

    private Billing $billing;

    private PaymentCard $paymentCard;


    public function setCreditCard(CreditCard $creditCard): self
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    public function getCreditCard(): CreditCard
    {
        return $this->creditCard;
    }

    public function setCreditCardToken(CreditCardToken $creditCardToken): self
    {
        $this->creditCardToken = $creditCardToken;
        return $this;
    }

    public function getCreditCardToken(): CreditCardToken
    {
        return $this->creditCardToken;
    }

    public function setPaymentCard(PaymentCard $paymentCard): self
    {
        $this->paymentCard = $paymentCard;
        return $this;
    }

    public function getPaymentCard(): PaymentCard
    {
        return $this->paymentCard;
    }

    public function setBilling(Billing $billing): self
    {
        $this->billing = $billing;
        return $this;
    }

    public function getBilling(): Billing
    {
        return $this->billing;
    }
}
