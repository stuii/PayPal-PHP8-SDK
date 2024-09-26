<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;

/**
 * Class Amount
 *
 * payment amount with break-ups.
 *
 * @package PayPal\Api
 *
 * @property string currency
 * @property string total
 * @property Details details
 */
class Amount extends PayPalModel
{
    private string $currency;

    private string $total;

    private Details $details;

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency(): string
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

    public function getTotal(): string
    {
        return $this->total;
    }

    public function setDetails(Details $details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getDetails(): Details
    {
        return $this->details;
    }

}
