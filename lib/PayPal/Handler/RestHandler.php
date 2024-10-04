<?php

namespace PayPal\Handler;

use Exception;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Common\PayPalUserAgent;
use PayPal\Core\PayPalConstants;
use PayPal\Core\PayPalCredentialManager;
use PayPal\Core\PayPalHttpConfig;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalInvalidCredentialException;
use PayPal\Exception\PayPalMissingCredentialException;
use Paypal\Rest\ApiContext;

/**
 * Class RestHandler
 */
class RestHandler implements PayPalHandlerInterface
{
    public function __construct(private readonly ApiContext $apiContext)
    {
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalInvalidCredentialException
     * @throws PayPalMissingCredentialException
     * @throws Exception
     * @throws Exception
     */
    public function handle(PayPalHttpConfig $httpConfig, string $request, array $options): void
    {
        $credential = $this->apiContext->getCredential();
        $config = $this->apiContext->getConfig();

        if ($credential === null) {
            // Try picking credentials from the config file
            $credMgr = PayPalCredentialManager::getInstance($config);
            $credValues = $credMgr->getCredentialObject();

            if (!is_array($credValues)) {
                throw new PayPalMissingCredentialException('Empty or invalid credentials passed');
            }

            $credential = new OAuthTokenCredential($credValues['clientId'], $credValues['clientSecret']);
        }

        if (!$credential instanceof OAuthTokenCredential) {
            throw new PayPalInvalidCredentialException('Invalid credentials passed');
        }
        $httpConfig->setUrl(
            rtrim(trim($this->getEndpoint($config)), '/') .
            ($options['path'] ?? '')
        );

        // Overwrite Expect Header to disable 100 Continue Issue
        $httpConfig->addHeader('Expect', null);

        if (!array_key_exists('User-Agent', $httpConfig->getHeaders())) {
            $httpConfig->addHeader('User-Agent', PayPalUserAgent::getValue(PayPalConstants::SDK_NAME, PayPalConstants::SDK_VERSION));
        }

        if ($httpConfig->getHeader('Authorization') === null) {
            $httpConfig->addHeader('Authorization', 'Bearer ' . $credential->getAccessToken($config), false);
        }

        if (
            $this->apiContext->getRequestId() !== null
            && ($httpConfig->getMethod() === 'POST' || $httpConfig->getMethod() === 'PUT')
        ) {
            $httpConfig->addHeader('PayPal-Request-Id', $this->apiContext->getRequestId());
        }
        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();
        foreach ($headers as $key => $value) {
            $httpConfig->addHeader($key, $value);
        }
    }

    /**
     * @throws PayPalConfigurationException
     */
    private function getEndpoint(array $config): string
    {
        if (isset($config['service.EndPoint'])) {
            return $config['service.EndPoint'];
        }

        if (isset($config['mode'])) {
            return match (strtoupper($config['mode'])) {
                'SANDBOX' => PayPalConstants::REST_SANDBOX_ENDPOINT,
                'LIVE' => PayPalConstants::REST_LIVE_ENDPOINT,
                default => throw new PayPalConfigurationException('The mode config parameter must be set to either sandbox/live'),
            };
        }

        // Defaulting to Sandbox
        return PayPalConstants::REST_SANDBOX_ENDPOINT;
    }
}
