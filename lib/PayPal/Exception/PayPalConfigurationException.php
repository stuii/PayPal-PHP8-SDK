<?php

namespace PayPal\Exception;

use Exception;

/**
 * Class PayPalConfigurationException
 *
 * @package PayPal\Exception
 */
class PayPalConfigurationException extends Exception
{
    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
