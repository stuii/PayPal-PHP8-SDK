<?php

namespace PayPal\Handler;

use PayPal\Core\PayPalHttpConfig;

interface PayPalHandlerInterface
{
    public function handle(PayPalHttpConfig $httpConfig, string $request, array $options);
}
