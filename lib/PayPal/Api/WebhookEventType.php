<?php

namespace PayPal\Api;

use JsonException;
use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use ReflectionException;

class WebhookEventType extends PayPalResourceModel
{
    private string $name;

    private string $description;

    private string $status;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function subscribedEventTypes(string $webhookId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): WebhookEventTypeList
    {
        ArgumentValidator::validate($webhookId, 'webhookId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/notifications/webhooks/' . $webhookId . '/event-types',
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookEventTypeList();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public static function availableEventTypes(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): WebhookEventTypeList
    {
        $payLoad = '';
        $json = self::executeCall(
            '/v1/notifications/webhooks-event-types',
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookEventTypeList();
        $ret->fromJson($json);
        return $ret;
    }
}
