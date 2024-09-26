<?php

namespace PayPal\Common;

class PayPalUserAgent
{
    public static function getValue(string $sdkName, string $sdkVersion): string
    {
        $featureList = array(
            'platform-ver=' . PHP_VERSION,
            'bit=' . self::getPHPBit(),
            'os=' . str_replace(' ', '_', php_uname('s') . ' ' . php_uname('r')),
            'machine=' . php_uname('m')
        );
        if (defined('OPENSSL_VERSION_TEXT')) {
            $opensslVersion = explode(' ', OPENSSL_VERSION_TEXT);
            $featureList[] = 'crypto-lib-ver=' . $opensslVersion[1];
        }
        if (function_exists('curl_version')) {
            $curlVersion = curl_version();
            $featureList[] = 'curl=' . $curlVersion['version'];
        }
        return sprintf('PayPalSDK/%s %s (%s)', $sdkName, $sdkVersion, implode('; ', $featureList));
    }

    private static function getPHPBit(): string
    {
        return match (PHP_INT_SIZE) {
            4 => '32',
            8 => '64',
            default => (string)PHP_INT_SIZE,
        };
    }
}
