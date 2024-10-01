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

class Authorization extends PayPalResourceModel
{
    private ?string $id = null;
    private ?Amount $amount = null;
    private ?string $paymentMode = null;
    private ?string $state = null;
    private ?string $reasonCode = null;
    private ?string $pendingReason = null;
    private ?string $protectionEligibility = null;
    private ?string $protectionEligibilityType = null;
    private ?FmfDetails $fmfDetails = null;
    private ?string $parentPayment = null;
    private ?ProcessorResponse $processorResponse = null;
    private ?string $validUntil = null;
    private ?string $createTime = null;
    private ?string $updateTime = null;
    private ?string $referenceId = null;
    private ?string $receiptId = null;


    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setAmount(Amount $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function setPaymentMode(string $paymentMode): self
    {
        $this->paymentMode = $paymentMode;
        return $this;
    }

    public function getPaymentMode(): ?string
    {
        return $this->paymentMode;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setReasonCode(string $reasonCode): self
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }

    public function getReasonCode(): ?string
    {
        return $this->reasonCode;
    }

    /**
     * @deprecated Reason code for the transaction state being Pending.Obsolete. use reason_code field instead.
     * Valid Values: ["AUTHORIZATION"]
     */
    public function setPendingReason(string $pendingReason): self
    {
        $this->pendingReason = $pendingReason;
        return $this;
    }

    /**
     * @deprecated  [DEPRECATED] Reason code for the transaction state being Pending.Obsolete. use reason_code field instead.
     */
    public function getPendingReason(): ?string
    {
        return $this->pendingReason;
    }

    public function setProtectionEligibility(string $protectionEligibility): self
    {
        $this->protectionEligibility = $protectionEligibility;
        return $this;
    }

    public function getProtectionEligibility(): ?string
    {
        return $this->protectionEligibility;
    }

    public function setProtectionEligibilityType(string $protectionEligibilityType): self
    {
        $this->protectionEligibilityType = $protectionEligibilityType;
        return $this;
    }

    public function getProtectionEligibilityType(): ?string
    {
        return $this->protectionEligibilityType;
    }

    public function setFmfDetails(FmfDetails $fmfDetails): self
    {
        $this->fmfDetails = $fmfDetails;
        return $this;
    }

    public function getFmfDetails(): ?FmfDetails
    {
        return $this->fmfDetails;
    }

    public function setParentPayment(string $parentPayment): self
    {
        $this->parentPayment = $parentPayment;
        return $this;
    }

    public function getParentPayment(): ?string
    {
        return $this->parentPayment;
    }

    public function setProcessorResponse(ProcessorResponse $processorResponse): self
    {
        $this->processorResponse = $processorResponse;
        return $this;
    }

    public function getProcessorResponse(): ?ProcessorResponse
    {
        return $this->processorResponse;
    }

    public function setValidUntil(string $validUntil): self
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    public function getValidUntil(): ?string
    {
        return $this->validUntil;
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

    public function setUpdateTime(string $updateTime): self
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    public function getUpdateTime(): ?string
    {
        return $this->updateTime;
    }

    public function setReferenceId(string $referenceId): self
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    public function setReceiptId(string $receiptId): self
    {
        $this->receiptId = $receiptId;
        return $this;
    }

    public function getReceiptId(): ?string
    {
        return $this->receiptId;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public static function get(string $authorizationId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Authorization
    {
        ArgumentValidator::validate($authorizationId, 'authorizationId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/authorization/' . $authorizationId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Authorization();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     */
    public function capture(Capture $capture, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Capture
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($capture, 'capture');
        $payLoad = $capture->toJSON();
        $json = self::executeCall(
            '/v1/payments/authorization/' . $this->getId() . '/capture',
            'POST',
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
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function void(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Authorization
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/authorization/' . $this->getId() . '/void',
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
    public function reauthorize(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Authorization
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            '/v1/payments/authorization/' . $this->getId() . '/reauthorize',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

}
