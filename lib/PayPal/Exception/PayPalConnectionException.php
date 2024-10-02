<?php

namespace PayPal\Exception;

use Exception;

/**
 * Class PayPalConnectionException
 *
 * @package PayPal\Exception
 */
class PayPalConnectionException extends Exception
{
    private string $url;

    private string $data;

    public function __construct(string $url, ?string $message, int $code = 0)
    {
        parent::__construct($message, $code);
        $this->url = $url;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
