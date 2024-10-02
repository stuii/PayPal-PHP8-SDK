<?php

namespace PayPal\Log;

class PayPalDefaultLogFactory implements PayPalLogFactory
{
    public function getLogger(string $className): PayPalLogger
    {
        return new PayPalLogger($className);
    }
}
