<?php

namespace PayPal\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Common\PayPalResourceModel;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\UrlValidator;
use ReflectionException;

class VerifyWebhookSignature extends PayPalResourceModel
{
    private ?string $authAlgo = null;
    private ?string $certUrl = null;
    private ?string $transmissionId = null;
    private ?string $transmissionSig = null;
    private ?string $transmissionTime = null;
    private ?string $webhookId = null;
    private ?WebhookEvent $webhookEvent = null;
    private ?string $requestBody = null;

    public function setAuthAlgo(string $authAlgo): self
    {
        $this->authAlgo = $authAlgo;
        return $this;
    }

    public function getAuthAlgo(): ?string
    {
        return $this->authAlgo;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setCertUrl(string $certUrl): self
    {
        UrlValidator::validate($certUrl, 'CertUrl');
        $this->certUrl = $certUrl;
        return $this;
    }

    public function getCertUrl(): ?string
    {
        return $this->certUrl;
    }

    public function setTransmissionId(string $transmissionId): self
    {
        $this->transmissionId = $transmissionId;
        return $this;
    }

    public function getTransmissionId(): ?string
    {
        return $this->transmissionId;
    }

    public function setTransmissionSig(string $transmissionSig): self
    {
        $this->transmissionSig = $transmissionSig;
        return $this;
    }

    public function getTransmissionSig(): ?string
    {
        return $this->transmissionSig;
    }

    public function setTransmissionTime(string $transmissionTime): self
    {
        $this->transmissionTime = $transmissionTime;
        return $this;
    }

    public function getTransmissionTime(): ?string
    {
        return $this->transmissionTime;
    }

    public function setWebhookId(string $webhookId): self
    {
        $this->webhookId = $webhookId;
        return $this;
    }

    public function getWebhookId(): ?string
    {
        return $this->webhookId;
    }

    /**
     * @deprecated Please use setRequestBody($requestBody) instead.
     */
    public function setWebhookEvent(WebhookEvent $webhookEvent): self
    {
        $this->webhookEvent = $webhookEvent;
        return $this;
    }

    public function getWebhookEvent(): ?WebhookEvent
    {
        return $this->webhookEvent;
    }

    public function setRequestBody(string $requestBody): self
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    public function getRequestBody(): ?string
    {
        return $this->requestBody;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function post(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): VerifyWebhookSignatureResponse
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            '/v1/notifications/verify-webhook-signature',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new VerifyWebhookSignatureResponse();
        $ret->fromJson($json);
        return $ret;
    }

    public function toJSON(int $options = 0): string
    {
        if ($this->requestBody !== null) {
            $valuesToEncode = $this->toArray();
            unset($valuesToEncode['webhook_event'], $valuesToEncode['request_body']);

            $payload = '{';
            foreach ($valuesToEncode as $field => $value) {
                $payload .= '"'. $field . '": "' . $value . '",';
            }
            $payload .= '"webhook_event": '. $this->requestBody;
            $payload .= '}';
            return $payload;
        }

        return parent::toJSON($options);
    }
}
