<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class ProcessorResponse extends PayPalModel
{
    private string $responseCode;

    private string $avsCode;

    private string $cvvCode;

    private string $adviceCode;

    private string $eciSubmitted;

    private string $vpas;


    public function setResponseCode(string $responseCode): self
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    public function getResponseCode(): string
    {
        return $this->responseCode;
    }

    public function setAvsCode(string $avsCode): self
    {
        $this->avsCode = $avsCode;
        return $this;
    }

    public function getAvsCode(): string
    {
        return $this->avsCode;
    }

    public function setCvvCode(string $cvvCode): self
    {
        $this->cvvCode = $cvvCode;
        return $this;
    }

    public function getCvvCode(): string
    {
        return $this->cvvCode;
    }

    public function setAdviceCode(string $adviceCode): self
    {
        $this->adviceCode = $adviceCode;
        return $this;
    }

    public function getAdviceCode(): string
    {
        return $this->adviceCode;
    }

    public function setEciSubmitted(string $eciSubmitted): self
    {
        $this->eciSubmitted = $eciSubmitted;
        return $this;
    }

    public function getEciSubmitted(): string
    {
        return $this->eciSubmitted;
    }

    public function setVpas(string $vpas): self
    {
        $this->vpas = $vpas;
        return $this;
    }

    public function getVpas(): string
    {
        return $this->vpas;
    }
}
