<?php

namespace PayPal\Exception;

use Exception;

/**
 * Class PayPalInvalidCredentialException
 *
 * @package PayPal\Exception
 */
class PayPalInvalidCredentialException extends Exception
{
    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function errorMessage(): string
    {
        return 'Error on line ' . $this->getLine() . ' in ' . $this->getFile() . ': <b>' . $this->getMessage() . '</b>';
    }
}
