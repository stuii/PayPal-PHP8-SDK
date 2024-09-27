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

class Sale extends PayPalResourceModel
{
    private string $id;

    private string $purchaseUnitReferenceId;

    private Amount $amount;

    private string $paymentMode;

    private string $state;

    private string $reasonCode;

    private string $protectionEligibility;

    private string $protectionEligibilityType;

    private string $clearingTime;

    private string $paymentHoldStatus;

    private array $paymentHoldReasons;

    private Currency $transactionFee;

    private Currency $receivableAmount;

    private string $exchangeRate;

    private FmfDetails $fmfDetails;

    private string $receiptId;

    private string $parentPayment;

    private ProcessorResponse $processorResponse;

    private string $billingAgreementId;

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

    public function setPurchaseUnitReferenceId(string $purchaseUnitReferenceId): self
    {
        $this->purchaseUnitReferenceId = $purchaseUnitReferenceId;
        return $this;
    }

    public function getPurchaseUnitReferenceId(): string
    {
        return $this->purchaseUnitReferenceId;
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

    public function setClearingTime(string $clearingTime): self
    {
        $this->clearingTime = $clearingTime;
        return $this;
    }

    public function getClearingTime(): string
    {
        return $this->clearingTime;
    }

    public function setPaymentHoldStatus(string $paymentHoldStatus): self
    {
        $this->paymentHoldStatus = $paymentHoldStatus;
        return $this;
    }

    public function getPaymentHoldStatus(): string
    {
        return $this->paymentHoldStatus;
    }

    /**
     * @param array<string> $paymentHoldReasons
     */
    public function setPaymentHoldReasons(array $paymentHoldReasons): self
    {
        $this->paymentHoldReasons = $paymentHoldReasons;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getPaymentHoldReasons(): array
    {
        return $this->paymentHoldReasons;
    }

    public function addPaymentHoldReason(string $string): self
    {
        if (!$this->getPaymentHoldReasons()) {
            return $this->setPaymentHoldReasons([$string]);
        }

        return $this->setPaymentHoldReasons(
            [...$this->getPaymentHoldReasons(), $string]
        );
    }

    public function removePaymentHoldReason(string $string): self
    {
        return $this->setPaymentHoldReasons(
            array_diff($this->getPaymentHoldReasons(), array($string))
        );
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

    public function setReceivableAmount(Currency $receivableAmount): self
    {
        $this->receivableAmount = $receivableAmount;
        return $this;
    }

    public function getReceivableAmount(): Currency
    {
        return $this->receivableAmount;
    }

    public function setExchangeRate(string $exchangeRate): self
    {
        $this->exchangeRate = $exchangeRate;
        return $this;
    }

    public function getExchangeRate(): string
    {
        return $this->exchangeRate;
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

    public function setReceiptId(string $receiptId): self
    {
        $this->receiptId = $receiptId;
        return $this;
    }

    public function getReceiptId(): string
    {
        return $this->receiptId;
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

    public function setProcessorResponse(ProcessorResponse $processorResponse): self
    {
        $this->processorResponse = $processorResponse;
        return $this;
    }

    public function getProcessorResponse(): ProcessorResponse
    {
        return $this->processorResponse;
    }

    public function setBillingAgreementId(string $billingAgreementId): self
    {
        $this->billingAgreementId = $billingAgreementId;
        return $this;
    }

    public function getBillingAgreementId(): string
    {
        return $this->billingAgreementId;
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
    public static function get(string $saleId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): Sale
    {
        ArgumentValidator::validate($saleId, 'saleId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/payments/sale/' . $saleId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Sale();
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
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($refund, 'refund');
        $payLoad = $refund->toJSON();
        $json = self::executeCall(
            "/v1/payments/sale/{$this->getId()}/refund",
            "POST",
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
    public function refundSale(RefundRequest $refundRequest, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): DetailedRefund
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($refundRequest, 'refundRequest');
        $payLoad = $refundRequest->toJSON();
        $json = self::executeCall(
            "/v1/payments/sale/{$this->getId()}/refund",
            "POST",
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
