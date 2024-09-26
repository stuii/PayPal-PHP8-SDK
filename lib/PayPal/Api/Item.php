<?php

namespace PayPal\Api;

use InvalidArgumentException;
use PayPal\Common\PayPalModel;
use PayPal\Converter\FormatConverter;
use PayPal\Validation\NumericValidator;
use PayPal\Validation\UrlValidator;

class Item extends PayPalModel
{
    private string $sku;

    private string $name;

    private string $description;

    private string $quantity;

    private string $price;

    private string $currency;

    private string $tax;

    private string $url;

    public function setSku(string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function setPrice(string|float $price): self
    {
        NumericValidator::validate($price, "Price");
        $price = FormatConverter::formatToPrice($price, $this->getCurrency());
        $this->price = $price;
        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setTax(string|float $tax): self
    {
        NumericValidator::validate($tax, "Tax");
        $tax = FormatConverter::formatToPrice($tax, $this->getCurrency());
        $this->tax = $tax;
        return $this;
    }

    public function getTax(): string
    {
        return $this->tax;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setUrl(string $url): self
    {
        UrlValidator::validate($url, "Url");
        $this->url = $url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
