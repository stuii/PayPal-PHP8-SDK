<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class WebhookEventList extends PayPalModel
{
    /** @var array<WebhookEvent> $events  */
    private array $events;

    private int $count;


    /**
     * @param array<WebhookEvent> $events
     */
    public function setEvents(array $events): self
    {
        $this->events = $events;
        return $this;
    }

    /**
     * @return array<WebhookEvent>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(WebhookEvent $webhookEvent): self
    {
        if (!$this->getEvents()) {
            return $this->setEvents([$webhookEvent]);
        }

        return $this->setEvents(
            [...$this->getEvents(), $webhookEvent]
        );
    }

    public function removeEvent(WebhookEvent $webhookEvent): self
    {
        return $this->setEvents(
            array_diff($this->getEvents(), [$webhookEvent])
        );
    }

    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param array<\PayPal\Api\Links> $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\Links>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function addLink(Links $links): self
    {
        if (!$this->getLinks()) {
            return $this->setLinks([$links]);
        }

        return $this->setLinks(
            [...$this->getLinks(), $links]
        );
    }

    public function removeLink(Links $links): self
    {
        return $this->setLinks(
            array_diff($this->getLinks(), [$links])
        );
    }

}
