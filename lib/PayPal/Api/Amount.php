<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;

class Amount extends PayPalModel
{
    private ?string $currency = null;

    private ?string $total = null;

    private ?Details $details = null;

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setTotal(string|float $total): self
    {
        NumericValidator::validate($total, "Total");
        $total = FormatConverter::formatToPrice($total, $this->getCurrency());
        $this->total = $total;
        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setDetails(Details $details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getDetails(): ?Details
    {
        return $this->details;
    }

}
