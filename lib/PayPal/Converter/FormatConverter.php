<?php

namespace PayPal\Converter;

use InvalidArgumentException;

class FormatConverter
{
    public static function formatToPrice(int|float $value, ?string $currency = null): string
    {
        $decimals = 2;
        $currencyDecimals = ['JPY' => 0, 'TWD' => 0, 'HUF' => 0,];
        if ($currency && array_key_exists($currency, $currencyDecimals)) {
            if (str_contains($value, '.') && (floor($value) !== (float) $value)) {
                //throw exception if it has decimal values for JPY, TWD and HUF which does not end with .00
                throw new InvalidArgumentException("value cannot have decimals for $currency currency");
            }
            $decimals = $currencyDecimals[$currency];
        } elseif (!str_contains($value, '.')) {
            // Check if value has decimal values. If not no need to assign 2 decimals with .00 at the end
            $decimals = 0;
        }

        return number_format($value, $decimals, '.', '');
    }
}
