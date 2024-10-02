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

class Capture extends PayPalResourceModel
{
    private string $id;

    private Amount $amount;

    private bool $isFinalCapture;

    private string $state;

    private string $reasonCode;

    private string $parentPayment;

    private string $invoiceNumber;

    private Currency $transactionFee;

    private string $createTime;

    private string $updateTime;


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

    public function setIsFinalCapture(bool $isFinalCapture): self
    {
        $this->isFinalCapture = $isFinalCapture;
        return $this;
    }

    public function getIsFinalCapture(): bool
    {
        return $this->isFinalCapture;
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

    public function setReasonCode(string $reasonCode): self
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }

    public function getReasonCode(): string
    {
        return $this->reasonCode;
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

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setTransactionFee(Currency $transactionFee): self
    {
        $this->transactionFee = $transactionFee;
        return $this;
    }

    public function getTransactionFee(): Currency
    {
        return $this->transactionFee;
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

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public static function get(string $captureId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($captureId, 'captureId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/capture/' . $captureId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Capture();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public function refund(Refund $refund, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Refund
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($refund, 'refund');
        $payLoad = $refund->toJSON();
        $json = self::executeCall(
            '/v1/payments/capture/' . $this->getId() . '/refund',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Refund();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public function refundCapturedPayment(RefundRequest $refundRequest, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): DetailedRefund
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($refundRequest, 'refundRequest');
        $payLoad = $refundRequest->toJSON();
        $json = self::executeCall(
            '/v1/payments/capture/' . $this->getId() . '/refund',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new DetailedRefund();
        $ret->fromJson($json);
        return $ret;
    }
}
