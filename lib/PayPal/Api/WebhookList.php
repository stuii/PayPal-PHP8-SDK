<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class WebhookList extends PayPalModel
{
    /** @var array<\PayPal\Api\Webhook> $webhooks  */
    private array $webhooks;

    /**
     * @param array<Webhook> $webhooks
     */
    public function setWebhooks(array $webhooks): self
    {
        $this->webhooks = $webhooks;
        return $this;
    }

    /**
     * @return array<Webhook>
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
}
