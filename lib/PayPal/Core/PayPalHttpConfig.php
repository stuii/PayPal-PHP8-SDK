<?php

namespace PayPal\Core;

use PayPal\Exception\PayPalConfigurationException;

class PayPalHttpConfig
{
    public static array $defaultCurlOptions = [
        CURLOPT_SSLVERSION => 6,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,    // maximum number of seconds to allow cURL functions to execute
        CURLOPT_USERAGENT => 'AbaNinja-PayPal-SDK',
        CURLOPT_HTTPHEADER => [],
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 1,
        CURLOPT_SSL_CIPHER_LIST => 'TLSv1:TLSv1.2'
        // Allowing TLSv1 cipher list.
        // Adding it like this for backward compatibility with older versions of curl
    ];

    const string HEADER_SEPARATOR = ';';
    const string HTTP_GET = 'GET';
    const string HTTP_POST = 'POST';

    private array $headers = [];

    private array $curlOptions;

    private ?string $url;

    private ?string $method;

    private int $retryCount = 0;

    public function __construct(?string $url = null, ?string $method = self::HTTP_POST, array $configs = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->curlOptions = $this->getHttpConstantsFromConfigs($configs, 'http.') + self::$defaultCurlOptions;
        // Update the Cipher List based on OpenSSL or NSS settings
        $curl = curl_version();
        $sslVersion = $curl['ssl_version'] ?? '';
        if($sslVersion && substr_compare($sslVersion, 'NSS/', 0, strlen('NSS/')) === 0) {
            //Remove the Cipher List for NSS
            $this->removeCurlOption(CURLOPT_SSL_CIPHER_LIST);
        }
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setHeaders(array $headers = []): void
    {
        $this->headers = $headers;
    }

    public function addHeader(string $name, string $value, bool $override = true): void
    {
        if (!array_key_exists($name, $this->headers) || $override) {
            $this->headers[$name] = $value;
        } else {
            $this->headers[$name] .= self::HEADER_SEPARATOR . $value;
        }
    }

    public function removeHeader(string $name): void
    {
        unset($this->headers[$name]);
    }

    public function getCurlOptions(): array
    {
        return $this->curlOptions;
    }

    public function addCurlOption(string $name, string|array $value): void
    {
        $this->curlOptions[$name] = $value;
    }

    public function removeCurlOption(string $name): void
    {
        unset($this->curlOptions[$name]);
    }

    public function setCurlOptions(array $options): void
    {
        $this->curlOptions = $options;
    }

    public function setSSLCert(string $certPath, ?string $passPhrase = null): void
    {
        $this->curlOptions[CURLOPT_SSLCERT] = realpath($certPath);
        if (isset($passPhrase) && trim($passPhrase) !== '') {
            $this->curlOptions[CURLOPT_SSLCERTPASSWD] = $passPhrase;
        }
    }
    public function setHttpTimeout(int $timeout): void
    {
        $this->curlOptions[CURLOPT_CONNECTTIMEOUT] = $timeout;
    }

    /**
     * @throws PayPalConfigurationException
     */
    public function setHttpProxy(string $proxy): void
    {
        $urlParts = parse_url($proxy);
        if ($urlParts === false || !array_key_exists('host', $urlParts)) {
            throw new PayPalConfigurationException('Invalid proxy configuration ' . $proxy);
        }
        $this->curlOptions[CURLOPT_PROXY] = $urlParts['host'];
        if (isset($urlParts['port'])) {
            $this->curlOptions[CURLOPT_PROXY] .= ':' . $urlParts['port'];
        }
        if (isset($urlParts['user'])) {
            $this->curlOptions[CURLOPT_PROXYUSERPWD] = $urlParts['user'] . ':' . $urlParts['pass'];
        }
    }

    public function setHttpRetryCount(int $retryCount): void
    {
        $this->retryCount = $retryCount;
    }

    public function getHttpRetryCount(): int
    {
        return $this->retryCount;
    }

    public function setUserAgent(string $userAgentString): void
    {
        $this->curlOptions[CURLOPT_USERAGENT] = $userAgentString;
    }

    public function getHttpConstantsFromConfigs(array $configs, string $prefix): array
    {
        $arr = [];
        foreach ($configs as $k => $v) {
            // Check if it startsWith
            if (str_starts_with($k, $prefix)) {
                $newKey = ltrim($k, $prefix);
                if (defined($newKey)) {
                    $arr[constant($newKey)] = $v;
                }
            }
        }
        return $arr;
    }
}
