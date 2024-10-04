<?php

namespace PayPal\Log;

use Psr\Log\AbstractLogger;

class PayPalDefaultLogFactory implements PayPalLogFactory
{
    public function getLogger(string $className): AbstractLogger
    {
        return new PayPalLogger($className);
    }
}
