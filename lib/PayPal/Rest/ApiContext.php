<?php /** @noinspection PhpDuplicatedCharacterInStrFunctionCallInspection */

namespace PayPal\Rest;

use Exception;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Core\PayPalConfigManager;
use PayPal\Core\PayPalCredentialManager;
use PayPal\Exception\PayPalInvalidCredentialException;

class ApiContext
{
    public function __construct(
        private readonly ?OAuthTokenCredential $credential = null,
        private ?string $requestId = null
    ) {
    }

    /**
     * @throws PayPalInvalidCredentialException
     * @throws Exception
     */
    public function getCredential(): ?OAuthTokenCredential
    {
        return $this->credential ?? PayPalCredentialManager::getInstance()->getCredentialObject() ?? null;
    }

    public function getRequestHeaders(): array
    {
        $result = PayPalConfigManager::getInstance()->get('http.headers');
        $headers = [];
        foreach ($result as $header => $value) {
            $headerName = ltrim($header, 'http.headers');
            $headers[$headerName] = $value;
        }
        return $headers;
    }

    public function addRequestHeader(string $name, $value): void
    {
        // Determine if the name already has a 'http.headers' prefix. If not, add one.
        if (!(str_starts_with($name, 'http.headers'))) {
            $name = 'http.headers.' . $name;
        }
        PayPalConfigManager::getInstance()->addConfigs([$name => $value]);
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }


    public function setConfig(array $config): void
    {
        PayPalConfigManager::getInstance()->addConfigs($config);
    }

    public function getConfig(): array
    {
        return PayPalConfigManager::getInstance()->getConfigHashmap();
    }

    public function get(string $searchKey): array
    {
        return PayPalConfigManager::getInstance()->get($searchKey);
    }
}
