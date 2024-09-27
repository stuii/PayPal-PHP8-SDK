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

class Order extends PayPalResourceModel
{
    private string $id;

    private string $referenceId;

    private Amount $amount;

    private string $paymentMode;

    private string $state;

    private string $reasonCode;

    private string $pendingReason;

    private string $protectionEligibility;

    private string $protectionEligibilityType;

    private string $parentPayment;

    private FmfDetails $fmfDetails;

    private string $createTime;

    private string $updateTime;

    private string $purchaseUnitReferenceId;


    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setPurchaseUnitReferenceId(string $purchaseUnitReferenceId): self
    {
        $this->purchaseUnitReferenceId = $purchaseUnitReferenceId;
        return $this;
    }

    public function getPurchaseUnitReferenceId(): string
    {
        return $this->purchaseUnitReferenceId;
    }

    public function setReferenceId(string $referenceId): self
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getReferenceId(): string
    {
        return $this->referenceId;
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

    public function setPaymentMode(string $paymentMode): self
    {
        $this->paymentMode = $paymentMode;
        return $this;
    }

    public function getPaymentMode(): string
    {
        return $this->paymentMode;
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

    /**
     * @deprecated [DEPRECATED] Reason code for the transaction state being Pending. Obsolete. Retained for backward compatability. Use reason_code field above instead.
     */
    public function setPendingReason(string $pendingReason): self
    {
        $this->pendingReason = $pendingReason;
        return $this;
    }

    /**
     * @deprecated [DEPRECATED] Reason code for the transaction state being Pending. Obsolete. Retained for backward compatability. Use reason_code field above instead.
     */
    public function getPendingReason(): string
    {
        return $this->pendingReason;
    }

    public function setProtectionEligibility(string $protectionEligibility): self
    {
        $this->protectionEligibility = $protectionEligibility;
        return $this;
    }

    public function getProtectionEligibility(): string
    {
        return $this->protectionEligibility;
    }

    public function setProtectionEligibilityType(string $protectionEligibilityType): self
    {
        $this->protectionEligibilityType = $protectionEligibilityType;
        return $this;
    }

    public function getProtectionEligibilityType(): string
    {
        return $this->protectionEligibilityType;
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

    public function setFmfDetails(FmfDetails $fmfDetails): self
    {
        $this->fmfDetails = $fmfDetails;
        return $this;
    }

    public function getFmfDetails(): FmfDetails
    {
        return $this->fmfDetails;
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
    public static function get(string $orderId, ApiContext $apiContext = null, PayPalRestCall $restCall = null): Order
    {
        ArgumentValidator::validate($orderId, 'orderId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/orders/' . $orderId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Order();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function capture(Capture $capture, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Capture
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($capture, 'capture');
        $payLoad = $capture->toJSON();
        $json = self::executeCall(
            '/v1/payments/orders/' . $this->getId() . '/capture',
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
    public function void(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Order
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/orders/' . $this->getId() . '/do-void',
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
    public function authorize(Authorization $authorization, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Authorization
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($authorization, 'Authorization');
        $payLoad = $authorization->toJSON();
        $json = self::executeCall(
            '/v1/payments/orders/' . $this->getId() . '/authorize',
            'POST',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Authorization();
        $ret->fromJson($json);
        return $ret;
    }

}
