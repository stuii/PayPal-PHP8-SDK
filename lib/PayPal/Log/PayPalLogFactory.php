<?php

namespace PayPal\Log;

use Psr\Log\LoggerInterface;

interface PayPalLogFactory
{
    public function getLogger(string $className): LoggerInterface;
}
