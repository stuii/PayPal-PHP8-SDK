<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;

class Details extends PayPalModel
{
    private string $subtotal;

    private string $shipping;

    private string $tax;

    private string $handlingFee;

    private string $shippingDiscount;

    private string $insurance;

    private string $giftWrap;

    private string $fee;

    public function setSubtotal(string|float $subtotal): self
    {
        NumericValidator::validate($subtotal, "Subtotal");
        $subtotal = FormatConverter::formatToPrice($subtotal);
        $this->subtotal = $subtotal;
        return $this;
    }

    public function getSubtotal(): string
    {
        return $this->subtotal;
    }

    public function setShipping(string|float $shipping): self
    {
        NumericValidator::validate($shipping, "Shipping");
        $shipping = FormatConverter::formatToPrice($shipping);
        $this->shipping = $shipping;
        return $this;
    }

    public function getShipping(): string
    {
        return $this->shipping;
    }

    public function setTax(string|float $tax): self
    {
        NumericValidator::validate($tax, "Tax");
        $tax = FormatConverter::formatToPrice($tax);
        $this->tax = $tax;
        return $this;
    }

    public function getTax(): string
    {
        return $this->tax;
    }

    public function setHandlingFee(string|float $handlingFee): self
    {
        NumericValidator::validate($handlingFee, "Handling Fee");
        $handlingFee = FormatConverter::formatToPrice($handlingFee);
        $this->handlingFee = $handlingFee;
        return $this;
    }

    public function getHandlingFee(): string
    {
        return $this->handlingFee;
    }

    public function setShippingDiscount(string|float $shippingDiscount): self
    {
        NumericValidator::validate($shippingDiscount, "Shipping Discount");
        $shippingDiscount = FormatConverter::formatToPrice($shippingDiscount);
        $this->shippingDiscount = $shippingDiscount;
        return $this;
    }

    public function getShippingDiscount(): string
    {
        return $this->shippingDiscount;
    }

    public function setInsurance(string|float $insurance): self
    {
        NumericValidator::validate($insurance, "Insurance");
        $insurance = FormatConverter::formatToPrice($insurance);
        $this->insurance = $insurance;
        return $this;
    }

    public function getInsurance(): string
    {
        return $this->insurance;
    }

    public function setGiftWrap(string|float $giftWrap): self
    {
        NumericValidator::validate($giftWrap, "Gift Wrap");
        $giftWrap = FormatConverter::formatToPrice($giftWrap);
        $this->giftWrap = $giftWrap;
        return $this;
    }

    public function getGiftWrap(): string
    {
        return $this->giftWrap;
    }

    public function setFee(string|float $fee): self
    {
        NumericValidator::validate($fee, "Fee");
        $fee = FormatConverter::formatToPrice($fee);
        $this->fee = $fee;
        return $this;
    }

    public function getFee(): string
    {
        return $this->fee;
    }
}
