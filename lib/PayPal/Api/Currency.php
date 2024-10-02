<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;

class Currency extends PayPalModel
{
    private string $currency;

    private string $value;


    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setValue(float|string $value): self
    {
        NumericValidator::validate($value, 'Value');
        $value = FormatConverter::formatToPrice($value, $this->getCurrency());
        $this->value = $value;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
