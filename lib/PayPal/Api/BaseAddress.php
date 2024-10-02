<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class BaseAddress extends PayPalModel
{
    private ?string $line1 = null;
    private ?string $line2 = null;
    private ?string $city = null;
    private ?string $countryCode = null;
    private ?string $postalCode = null;
    private ?string $state = null;
    private ?string $normalizationStatus = null;
    private ?string $status = null;

    public function setLine1(string $line1): self
    {
        $this->line1 = $line1;
        return $this;
    }

    public function getLine1(): ?string
    {
        return $this->line1;
    }

    public function setLine2(string $line2): self
    {
        $this->line2 = $line2;
        return $this;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setNormalizationStatus(string $normalizationStatus): self
    {
        $this->normalizationStatus = $normalizationStatus;
        return $this;
    }

    public function getNormalizationStatus(): ?string
    {
        return $this->normalizationStatus;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
}
