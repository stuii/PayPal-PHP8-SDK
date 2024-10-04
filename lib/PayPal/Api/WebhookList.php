<?php

namespace PayPal\Api;

use JsonException;
use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use ReflectionException;

class WebhookList extends PayPalResourceModel
{
    /** @var array<\PayPal\Api\Webhook> $webhooks  */
    private array $webhooks;

    /**
     * @param array<\PayPal\Api\Webhook> $webhooks
     */
    public function setWebhooks(array $webhooks): self
    {
        $this->webhooks = $webhooks;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\Webhook>
     */
    public function getWebhooks(): array
    {
        return $this->webhooks;
    }

    public function addWebhook(Webhook $webhook): ?self
    {
        if (!$this->getWebhooks()) {
            return $this->setWebhooks([$webhook]);
        }

        return $this->setWebhooks(
            [...$this->getWebhooks(), $webhook]
        );
    }

    public function removeWebhook(Webhook $webhook): self
    {
        return $this->setWebhooks(
            array_diff($this->getWebhooks(), [$webhook])
        );
    }

    /**
     * @throws ReflectionException
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws PayPalConnectionException
     */
    public function getAllWebhooks(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        $json = self::executeCall(
            '/v1/notifications/webhooks',
            'GET',
            '',
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }
}
