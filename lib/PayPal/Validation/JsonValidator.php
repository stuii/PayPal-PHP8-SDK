<?php /** @noinspection JsonEncodingApiUsageInspection */

namespace PayPal\Validation;

use InvalidArgumentException;

class JsonValidator
{
    public static function validate(?string $string, bool $silent = false): bool
    {
        @json_decode($string);
        if (json_last_error() !== JSON_ERROR_NONE) {
            if ($string === '' || $string === null) {
                return true;
            }
            if (!$silent) {
                //Throw an Exception for string or array
                throw new InvalidArgumentException("Invalid JSON String");
            }
            return false;
        }
        return true;
    }
}
