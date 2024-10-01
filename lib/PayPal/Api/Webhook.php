<?php

namespace PayPal\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Validation\UrlValidator;
use ReflectionException;

class Webhook extends PayPalResourceModel
{
    private string $id;

    private string $url;

    /** @var array<\PayPal\Api\WebhookEventType> $eventTypes */
    private array $eventTypes;

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setUrl(string $url): self
    {
        UrlValidator::validate($url, "Url");
        $this->url = $url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

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

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function create(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Webhook
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            '/v1/notifications/webhooks',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public static function get(string $webhookId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Webhook
    {
        ArgumentValidator::validate($webhookId, 'webhookId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/notifications/webhooks/' . $webhookId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Webhook();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @deprecated Please use Webhook#getAllWithParams instead.
     *
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public static function getAll(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): WebhookList
    {
        return self::getAllWithParams(array(), $apiContext, $restCall);
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public static function getAllWithParams(array $params = array(), ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): WebhookList
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = '';
        $allowedParams =  [
            'anchor_type' => 1,
        ];
        $json = self::executeCall(
            '/v1/notifications/webhooks?' . http_build_query(array_intersect_key($params, $allowedParams)),
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookList();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function update(PatchRequest $patchRequest, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Webhook
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($patchRequest, 'patchRequest');
        $payLoad = $patchRequest->toJSON();
        $json = self::executeCall(
            '/v1/notifications/webhooks/' . $this->getId(),
            'PATCH',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function delete(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): bool
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payLoad = '';
        self::executeCall(
            '/v1/notifications/webhooks/' . $this->getId(),
            'DELETE',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }

}
