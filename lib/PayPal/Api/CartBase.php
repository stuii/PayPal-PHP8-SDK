<?php

namespace PayPal\Api;

use InvalidArgumentException;
use PayPal\Common\PayPalModel;
use PayPal\Validation\UrlValidator;

class CartBase extends PayPalModel
{
    private ?string $referenceId = null;
    private ?Amount $amount = null;
    private ?Payee $payee = null;
    private ?string $description = null;
    private ?string $noteToPayee = null;
    private ?string $custom = null;
    private ?string $invoiceNumber = null;
    private ?string $purchaseOrder = null;
    private ?string $softDescriptor = null;
    private ?PaymentOptions $paymentOptions = null;
    private ?ItemList $itemList = null;
    private ?string $notifyUrl = null;
    private ?string $orderUrl = null;

    public function setReferenceId(string $referenceId): self
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    public function getReferenceId(): ?string
    {
        return $this->referenceId;
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

    public function setPayee(Payee $payee): self
    {
        $this->payee = $payee;
        return $this;
    }

    public function getPayee(): ?Payee
    {
        return $this->payee;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setNoteToPayee(string $noteToPayee): self
    {
        $this->noteToPayee = $noteToPayee;
        return $this;
    }

    public function getNoteToPayee(): ?string
    {
        return $this->noteToPayee;
    }

    public function setCustom(string $custom): self
    {
        $this->custom = $custom;
        return $this;
    }

    public function getCustom(): ?string
    {
        return $this->custom;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setPurchaseOrder(string $purchaseOrder): self
    {
        $this->purchaseOrder = $purchaseOrder;
        return $this;
    }

    public function getPurchaseOrder(): ?string
    {
        return $this->purchaseOrder;
    }

    public function setSoftDescriptor(string $softDescriptor): self
    {
        $this->softDescriptor = $softDescriptor;
        return $this;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->softDescriptor;
    }

    public function setPaymentOptions(PaymentOptions $paymentOptions): self
    {
        $this->paymentOptions = $paymentOptions;
        return $this;
    }

    public function getPaymentOptions(): ?PaymentOptions
    {
        return $this->paymentOptions;
    }

    public function setItemList(ItemList $itemList): self
    {
        $this->itemList = $itemList;
        return $this;
    }

    public function getItemList(): ?ItemList
    {
        return $this->itemList;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setNotifyUrl(string $notifyUrl): self
    {
        UrlValidator::validate($notifyUrl, 'NotifyUrl');
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    public function getNotifyUrl(): ?string
    {
        return $this->notifyUrl;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setOrderUrl(string $orderUrl): self
    {
        UrlValidator::validate($orderUrl, 'OrderUrl');
        $this->orderUrl = $orderUrl;
        return $this;
    }

    public function getOrderUrl(): ?string
    {
        return $this->orderUrl;
    }
}
