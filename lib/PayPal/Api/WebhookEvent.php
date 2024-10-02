<?php

namespace PayPal\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Common\PayPalModel;
use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use PayPal\Validation\JsonValidator;
use ReflectionException;

class WebhookEvent extends PayPalResourceModel
{
    private ?string $id = null;
    private ?string $createTime = null;
    private ?string $resourceType = null;
    private ?string $eventVersion = null;
    private ?string $eventType = null;
    private ?string $summary = null;
    private ?PayPalModel $resource = null;


    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setCreateTime(string $createTime): self
    {
        $this->createTime = $createTime;
        return $this;
    }

    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

    public function setResourceType(string $resourceType): self
    {
        $this->resourceType = $resourceType;
        return $this;
    }

    public function getResourceType(): ?string
    {
        return $this->resourceType;
    }

    public function setEventVersion(string $eventVersion): self
    {
        $this->eventVersion = $eventVersion;
        return $this;
    }

    public function getEventVersion(): ?string
    {
        return $this->eventVersion;
    }

    public function setEventType(string $eventType): self
    {
        $this->eventType = $eventType;
        return $this;
    }

    public function getEventType(): ?string
    {
        return $this->eventType;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setResource(PayPalModel $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getResource(): ?PayPalModel
    {
        return $this->resource;
    }

    /**
     * Validates Received Event from Webhook, and returns the webhook event object. Because security verifications by verifying certificate chain is not enabled in PHP yet,
     * we need to fall back to default behavior of retrieving the ID attribute of the data, and make a separate GET call to PayPal APIs, to retrieve the data.
     * This is important to do again, as hacker could have faked the data, and the retrieved data cannot be trusted without either doing client side security validation, or making a separate call
     * to PayPal APIs to retrieve the actual data. This limits the hacker to mimic a fake data, as hacker won't be able to predict the ID correctly.
     *
     * NOTE: PLEASE DO NOT USE THE DATA PROVIDED IN WEBHOOK DIRECTLY, AS HACKER COULD PASS IN FAKE DATA. IT IS VERY IMPORTANT THAT YOU RETRIEVE THE ID AND MAKE A SEPARATE CALL TO PAYPAL API.
     *
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     * @deprecated Please use `VerifyWebhookSignature->post()` instead.
     *
     */
    public static function validateAndGetReceivedEvent(string $body, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        if ($body === null | empty($body)){
            throw new InvalidArgumentException('Body cannot be null or empty');
        }
        if (!JsonValidator::validate($body, true)) {
            throw new InvalidArgumentException('Request Body is not a valid JSON.');
        }
        $object = new WebhookEvent($body);
        if ($object->getId() === null) {
            throw new InvalidArgumentException('ID attribute not found in JSON. Possible reason could be invalid JSON Object');
        }
        try {
            return self::get($object->getId(), $apiContext, $restCall);
        } catch(PayPalConnectionException $ex) {
            if ($ex->getCode() === 404) {
                // It means that the given webhook event ID is not found for this merchant.
                throw new InvalidArgumentException('Webhook Event Id provided in the data is incorrect. This could happen if anyone other than PayPal is faking the incoming webhook data.');
            }
            throw $ex;
        }
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public static function get(string $eventId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($eventId, 'eventId');
        $payload = '';
        $json = self::executeCall(
            '/v1/notifications/webhooks-events/ '. $eventId,
            'GET',
            $payload,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookEvent();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Resends a webhook event notification, by ID. Any pending notifications are not resent.
     *
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public function resend(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payload = '';
        $json = self::executeCall(
            '/v1/notifications/webhooks-events/' . $this->getId() . '/resend',
            'POST',
            $payload,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public static function all(array $params, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): WebhookEventList
    {
        ArgumentValidator::validate($params, 'params');
        $payLoad = '';
        $allowedParams = [
          'page_size' => 1,
          'start_time' => 1,
          'end_time' => 1,
          'transaction_id' => 1,
          'event_type' => 1,
      ];
        $json = self::executeCall(
            '/v1/notifications/webhooks-events' . '?' . http_build_query(array_intersect_key($params, $allowedParams)),
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new WebhookEventList();
        $ret->fromJson($json);
        return $ret;
    }

}
