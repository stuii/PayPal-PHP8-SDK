<?php

namespace PayPal\Validation;

use InvalidArgumentException;

class ArgumentValidator
{
    public static function validate(mixed $argument, ?string $argumentName = null): bool
    {
        if ($argument === null) {
            // Error if Object Null
            throw new InvalidArgumentException("$argumentName cannot be null");
        }

        if (is_string($argument) && trim($argument) === '') {
            // Error if String Empty
            throw new InvalidArgumentException("$argumentName string cannot be empty");
        }
        return true;
    }
}
