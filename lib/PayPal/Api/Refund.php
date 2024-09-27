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

class Refund extends PayPalResourceModel
{
    private string $id;

    private Amount $amount;

    private string $state;

    private string $reason;

    private string $invoiceNumber;

    private string $saleId;

    private string $captureId;

    private string $parentPayment;

    private string $description;

    private string $createTime;

    private string $updateTime;

    private string $reasonCode;


    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setAmount(Amount $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): Amount
    {
        return $this->amount;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setSaleId(string $saleId): self
    {
        $this->saleId = $saleId;
        return $this;
    }

    public function getSaleId(): string
    {
        return $this->saleId;
    }

    public function setCaptureId(string $captureId): self
    {
        $this->captureId = $captureId;
        return $this;
    }

    public function getCaptureId(): string
    {
        return $this->captureId;
    }

    public function setParentPayment(string $parentPayment): self
    {
        $this->parentPayment = $parentPayment;
        return $this;
    }

    public function getParentPayment(): string
    {
        return $this->parentPayment;
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

    public function setCreateTime(string $createTime): self
    {
        $this->createTime = $createTime;
        return $this;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setUpdateTime(string $updateTime): self
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function setReasonCode(string $reasonCode): self
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }

    public function getReasonCode(): string
    {
        return $this->reasonCode;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public static function get(string $refundId, ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($refundId, 'refundId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/refund/' . $refundId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Refund();
        $ret->fromJson($json);
        return $ret;
    }
}
