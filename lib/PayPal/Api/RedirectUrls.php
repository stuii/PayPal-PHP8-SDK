<?php

namespace PayPal\Api;

use InvalidArgumentException;
use PayPal\Common\PayPalModel;
use PayPal\Validation\UrlValidator;

class RedirectUrls extends PayPalModel
{
    private string $returnUrl;

    private string $cancelUrl;


    /**
     * @throws InvalidArgumentException
     */
    public function setReturnUrl(string $returnUrl): self
    {
        UrlValidator::validate($returnUrl, 'ReturnUrl');
        $this->returnUrl = $returnUrl;
        return $this;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setCancelUrl(string $cancelUrl): self
    {
        UrlValidator::validate($cancelUrl, 'CancelUrl');
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

}
