<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class WebhookEventTypeList extends PayPalModel
{
    /** @var array<WebhookEventType> $eventTypes */
    private array $eventTypes;

    /**
     * @param array<WebhookEventType> $eventTypes
     */
    public function setEventTypes(array $eventTypes): self
    {
        $this->eventTypes = $eventTypes;
        return $this;
    }

    /**
     * @return array<WebhookEventType>
     */
    public function getEventTypes(): array
    {
        return $this->eventTypes;
    }

    public function addEventType(WebhookEventType $webhookEventType): ?self
    {
        if (!$this->getEventTypes()) {
            return $this->setEventTypes([$webhookEventType]);
        }

        return $this->setEventTypes(
            [...$this->getEventTypes(), $webhookEventType]
        );
    }

    public function removeEventType(WebhookEventType $webhookEventType): self
    {
        return $this->setEventTypes(
            array_diff($this->getEventTypes(), [$webhookEventType])
        );
    }
}
