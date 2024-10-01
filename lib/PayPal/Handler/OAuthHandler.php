<?php

namespace PayPal\Handler;

use PayPal\Common\PayPalUserAgent;
use PayPal\Core\PayPalConstants;
use PayPal\Core\PayPalHttpConfig;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalInvalidCredentialException;
use PayPal\Exception\PayPalMissingCredentialException;
use PayPal\Rest\ApiContext;

/**
 * Class OauthHandler
 */
class OAuthHandler implements PayPalHandlerInterface
{
    public function __construct(private ApiContext $apiContext)
    {
    }

    /**
     * @throws PayPalConfigurationException
     */
    public function handle(PayPalHttpConfig $httpConfig, ?string $request, array $options = []): void
    {
        $config = $this->apiContext->getConfig();

        $httpConfig->setUrl(rtrim(trim(self::_getEndpoint($config)), '/') . ($options['path'] ?? ''));

        $headers = [
            'User-Agent' => PayPalUserAgent::getValue(PayPalConstants::SDK_NAME, PayPalConstants::SDK_VERSION),
            'Authorization' => 'Basic ' . base64_encode($options['clientId'] . ':' . $options['clientSecret']),
            'Accept' => '*/*',
        ];
        $httpConfig->setHeaders($headers);

        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();
        foreach ($headers as $key => $value) {
            $httpConfig->addHeader($key, $value);
        }
    }

    /**
     * @throws PayPalConfigurationException
     */
    private static function _getEndpoint(array $config): string
    {
        if (isset($config['oauth.EndPoint'])) {
            $baseEndpoint = $config['oauth.EndPoint'];
        } elseif (isset($config['service.EndPoint'])) {
            $baseEndpoint = $config['service.EndPoint'];
        } elseif (isset($config['mode'])) {
            switch (strtoupper($config['mode'])) {
                case 'SANDBOX':
                    $baseEndpoint = PayPalConstants::REST_SANDBOX_ENDPOINT;
                    break;
                case 'LIVE':
                    $baseEndpoint = PayPalConstants::REST_LIVE_ENDPOINT;
                    break;
                default:
                    throw new PayPalConfigurationException('The mode config parameter must be set to either sandbox/live');
            }
        } else {
            // Defaulting to Sandbox
            $baseEndpoint = PayPalConstants::REST_SANDBOX_ENDPOINT;
        }

        $baseEndpoint = rtrim(trim($baseEndpoint), '/') . '/v1/oauth2/token';

        return $baseEndpoint;
    }
}