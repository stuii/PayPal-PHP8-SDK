<?php

namespace PayPal\Log;

use Psr\Log\AbstractLogger;

class PayPalDefaultLogFactory implements PayPalLogFactory
{
    public function getLogger(string $className): PayPalLogger
    {
        return new PayPalLogger($className);
    }
}
