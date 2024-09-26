<?php

namespace PayPal\Validation;

use InvalidArgumentException;

class UrlValidator
{
    public static function validate(string $url, ?string $urlName = null): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException("$urlName is not a fully qualified URL");
        }
    }
}
