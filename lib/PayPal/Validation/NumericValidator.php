<?php

namespace PayPal\Validation;

use InvalidArgumentException;

class NumericValidator
{

    public static function validate(mixed $argument, ?string $argumentName = null): bool
    {
        if (!is_numeric($argument) && trim($argument) !== null) {
            throw new InvalidArgumentException("$argumentName is not a valid numeric value");
        }
        return true;
    }
}
