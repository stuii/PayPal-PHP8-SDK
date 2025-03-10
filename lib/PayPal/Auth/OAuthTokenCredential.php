<?php /** @noinspection PhpMissingParentConstructorInspection */

namespace PayPal\Auth;

use Exception;
use JsonException;
use PayPal\Cache\AuthorizationCache;
use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalHttpConfig;
use PayPal\Core\PayPalHttpConnection;
use PayPal\Core\PayPalLoggingManager;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Exception\PayPalInvalidCredentialException;
use PayPal\Exception\PayPalMissingCredentialException;
use PayPal\Handler\OAuthHandler;
use PayPal\Handler\PayPalHandlerInterface;
use PayPal\Handler\RestHandler;
use PayPal\Rest\ApiContext;
use PayPal\Security\Cipher;

/**
 * Class OAuthTokenCredential
 */
class OAuthTokenCredential extends PayPalResourceModel
{

    public const AUTH_HANDLER = OAuthHandler::class;

    public static int $expiryBufferTime = 120;

    private string $clientId;

    private string $clientSecret;

    private ?string $targetSubject = null;

    private ?string $accessToken = null;

    private ?int $tokenExpiresIn = null;

    private float $tokenCreateTime;

    private Cipher $cipher;

    /** @noinspection MagicMethodsValidityInspection */
    public function __construct(string $clientId, string $clientSecret, ?string $targetSubject = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->cipher = new Cipher($this->clientSecret);
        $this->targetSubject = $targetSubject;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @throws Exception
     */
    public function getAccessToken($config): ?string
    {
        // Check if we already have accessToken in Cache
        if ($this->accessToken && (time() - $this->tokenCreateTime) < ($this->tokenExpiresIn - self::$expiryBufferTime)) {
            return $this->accessToken;
        }
        // Check for persisted data first
        $token = AuthorizationCache::pull($config, $this->clientId);
        if ($token) {
            // We found it
            // This code block is for backward compatibility only.
            if (array_key_exists('accessToken', $token)) {
                $this->accessToken = $token['accessToken'];
            }

            $this->tokenCreateTime = $token['tokenCreateTime'];
            $this->tokenExpiresIn = $token['tokenExpiresIn'];

            // Case where we have an old unencrypted cache file
            if (!array_key_exists('accessTokenEncrypted', $token)) {
                AuthorizationCache::push($config, $this->clientId, $this->encrypt($this->accessToken), $this->tokenCreateTime, $this->tokenExpiresIn);
            } else {
                $this->accessToken = $this->decrypt($token['accessTokenEncrypted']);
            }
        }

        // Check if Access Token is not null and has not expired.
        // The API returns expiry time as a relative time unit
        // We use a buffer time when checking for token expiry to account
        // for API call delays and any delay between the time the token is
        // retrieved and subsequently used
        if (
            $this->accessToken !== null &&
            (time() - $this->tokenCreateTime) > ($this->tokenExpiresIn - self::$expiryBufferTime)
        ) {
            $this->accessToken = null;
        }


        // If accessToken is Null, obtain a new token
        if ($this->accessToken === null) {
            // Get a new one by making calls to API
            $this->refreshAccessToken($config);
            AuthorizationCache::push($config, $this->clientId, $this->encrypt($this->accessToken), $this->tokenCreateTime, $this->tokenExpiresIn);
        }

        return $this->accessToken;
    }


    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function getRefreshToken(array $config, ?string $authorizationCode = null, array $params = []): ?string
    {
        static $allowedParams = [
            'grant_type' => 'authorization_code',
            'code' => 1,
            'redirect_uri' => 'urn:ietf:wg:oauth:2.0:oob',
            'response_type' => 'token',
        ];

        $params = is_array($params) ? $params : [];
        if ($authorizationCode) {
            //Override the authorizationCode if value is explicitly set
            $params['code'] = $authorizationCode;
        }
        $payload = http_build_query(array_merge($allowedParams, array_intersect_key($params, $allowedParams)));

        $response = $this->getToken($config, $this->clientId, $this->clientSecret, $payload);

        if ($response !== [] && isset($response['refresh_token'])) {
            return $response['refresh_token'];
        }

        return null;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function refreshAccessToken(array $config, ?string $refreshToken = null): ?string
    {
        $this->generateAccessToken($config, $refreshToken);
        return $this->accessToken;
    }

    /**
     * @param array $config
     * @param string $clientId
     * @param string $clientSecret
     * @param string $payload
     * @return array
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    protected function getToken(array $config, string $clientId, string $clientSecret, string $payload): array
    {
        $httpConfig = new PayPalHttpConfig(null, 'POST', $config);

        // if proxy set via config, add it
        if (!empty($config['http.Proxy'])) {
            $httpConfig->setHttpProxy($config['http.Proxy']);
        }

        $handlers = [self::AUTH_HANDLER];

        /** @var PayPalHandlerInterface $handler */
        foreach ($handlers as $handler) {
            if (!is_object($handler)) {
                $apiContext = new ApiContext($this);
                $apiContext->setConfig($config);
                $handler = new $handler($apiContext);
            }
            $handler->handle(
                $httpConfig,
                $payload,
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );
        }

        $connection = new PayPalHttpConnection($httpConfig, $config);
        $res = $connection->execute($payload);

        return json_decode($res, true, JSON_THROW_ON_ERROR, JSON_THROW_ON_ERROR);
    }


    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    private function generateAccessToken(array $config, ?string $refreshToken = null): void
    {
        $params = ['grant_type' => 'client_credentials'];
        if ($refreshToken !== null) {
            // If the refresh token is provided, it would get access token using refresh token
            // Used for Future Payments
            $params['grant_type'] = 'refresh_token';
            $params['refresh_token'] = $refreshToken;
        }
        if ($this->targetSubject !== null) {
            $params['target_subject'] = $this->targetSubject;
        }
        $payload = http_build_query($params);
        $response = $this->getToken($config, $this->clientId, $this->clientSecret, $payload);

        if ($response === [] || !isset($response['access_token'], $response['expires_in'])) {
            $this->accessToken = null;
            $this->tokenExpiresIn = null;
            PayPalLoggingManager::getInstance()->warning('Could not generate new Access token. Invalid response from server: ');
            throw new PayPalConnectionException(null, 'Could not generate new Access token. Invalid response from server: ');
        }
        $this->accessToken = $response['access_token'];
        $this->tokenExpiresIn = $response['expires_in'];
        $this->tokenCreateTime = time();

    }

    public function encrypt(string $data): string
    {
        return $this->cipher->encrypt($data);
    }

    public function decrypt(string $data): string
    {
        return $this->cipher->decrypt($data);
    }
}
