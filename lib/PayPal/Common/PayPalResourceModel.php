<?php

namespace PayPal\Common;

use JsonException;
use PayPal\Api\Links;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Exception\PayPalInvalidCredentialException;
use PayPal\Exception\PayPalMissingCredentialException;
use PayPal\Handler\RestHandlerInterface;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;

class PayPalResourceModel extends PayPalModel
{
    /** @var array<Links> $links  */
    public array $links = [];

    /**
     * @param array<Links> $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return array<Links>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function getLink(string $rel): ?string
    {
        foreach ($this->links as $link) {
            if ($link->getRel() === $rel) {
                return $link->getHref();
            }
        }
        return null;
    }

    public function addLink(Links $links): self
    {
        if (!$this->getLinks()) {
            return $this->setLinks(array($links));
        }
        return $this->setLinks(
            array_merge($this->getLinks(), array($links))
        );
    }

    public function removeLink(Links $links): self
    {
        return $this->setLinks(
            array_diff($this->getLinks(), array($links))
        );
    }


    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    protected static function executeCall(
        string $url,
        string $method,
        string $payload,
        ?array $headers = [],
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null,
        array $handlers = [RestHandlerInterface::class]
    ): string {
        //Initialize the context and rest call object if not provided explicitly
        $apiContext = $apiContext ?: new ApiContext(self::$credential);
        $restCall = $restCall ?: new PayPalRestCall($apiContext);

        //Make the execution call
        return $restCall->execute($handlers, $url, $method, $payload, $headers);
    }

    /**
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalInvalidCredentialException
     * @throws PayPalMissingCredentialException
     */
    public function updateAccessToken(?string $refreshToken, ?ApiContext $apiContext): void
    {
        $apiContext ??= new ApiContext(self::$credential);
        $apiContext->getCredential()?->refreshAccessToken($apiContext->getConfig(), $refreshToken);
    }
}
