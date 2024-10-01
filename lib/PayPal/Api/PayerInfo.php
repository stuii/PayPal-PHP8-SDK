<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PayerInfo extends PayPalModel
{
    private ?string $email = null;
    private ?string $externalRememberMeId = null;
    private ?string $buyerAccountNumber = null;
    private ?string $salutation = null;
    private ?string $firstName = null;
    private ?string $middleName = null;
    private ?string $lastName = null;
    private ?string $suffix = null;
    private ?string $payerId = null;
    private ?string $phone = null;
    private ?string $phoneType = null;
    private ?string $birthDate = null;
    private ?string $taxId = null;
    private ?string $taxIdType = null;
    private ?string $countryCode = null;
    private ?Address $billingAddress = null;

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setExternalRememberMeId(string $externalRememberMeId): self
    {
        $this->externalRememberMeId = $externalRememberMeId;
        return $this;
    }

    public function getExternalRememberMeId(): ?string
    {
        return $this->externalRememberMeId;
    }

    public function setBuyerAccountNumber(string $buyerAccountNumber): self
    {
        $this->buyerAccountNumber = $buyerAccountNumber;
        return $this;
    }

    public function getBuyerAccountNumber(): ?string
    {
        return $this->buyerAccountNumber;
    }

    public function setSalutation(string $salutation): self
    {
        $this->salutation = $salutation;
        return $this;
    }

    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setMiddleName(string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setSuffix(string $suffix): self
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    public function setPayerId(string $payerId): self
    {
        $this->payerId = $payerId;
        return $this;
    }

    public function getPayerId(): ?string
    {
        return $this->payerId;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhoneType(string $phoneType): self
    {
        $this->phoneType = $phoneType;
        return $this;
    }

    public function getPhoneType(): ?string
    {
        return $this->phoneType;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function setTaxId(string $taxId): self
    {
        $this->taxId = $taxId;
        return $this;
    }

    public function getTaxId(): ?string
    {
        return $this->taxId;
    }

    public function setTaxIdType(string $taxIdType): self
    {
        $this->taxIdType = $taxIdType;
        return $this;
    }

    public function getTaxIdType(): ?string
    {
        return $this->taxIdType;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setBillingAddress(Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }
}
