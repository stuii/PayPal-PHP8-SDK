<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PaymentCard extends PayPalModel
{
    private string $id;

    private string $number;

    private string $type;

    private string $expireMonth;

    private string $expireYear;

    private string $startMonth;

    private string $startYear;

    private string $cvv2;

    private string $firstName;

    private string $lastName;

    private string $billingCountry;

    private Address $billingAddress;

    private string $externalCustomerId;

    private string $status;

    private string $cardProductClass;

    private string $validUntil;

    private string $issueNumber;

    /** @var array<Links> $links */
    private array $links;


    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setExpireMonth(string $expireMonth): self
    {
        $this->expireMonth = $expireMonth;
        return $this;
    }

    public function getExpireMonth(): string
    {
        return $this->expireMonth;
    }

    public function setExpireYear(string $expireYear): self
    {
        $this->expireYear = $expireYear;
        return $this;
    }

    public function getExpireYear(): string
    {
        return $this->expireYear;
    }

    public function setStartMonth(string $startMonth): self
    {
        $this->startMonth = $startMonth;
        return $this;
    }

    public function getStartMonth(): string
    {
        return $this->startMonth;
    }

    public function setStartYear(string $startYear): self
    {
        $this->startYear = $startYear;
        return $this;
    }

    public function getStartYear(): string
    {
        return $this->startYear;
    }

    public function setCvv2(string $cvv2): self
    {
        $this->cvv2 = $cvv2;
        return $this;
    }

    public function getCvv2(): string
    {
        return $this->cvv2;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setBillingCountry(string $billingCountry): self
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    public function getBillingCountry(): string
    {
        return $this->billingCountry;
    }

    public function setBillingAddress(Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }

    public function setExternalCustomerId(string $externalCustomerId): self
    {
        $this->externalCustomerId = $externalCustomerId;
        return $this;
    }

    public function getExternalCustomerId(): string
    {
        return $this->externalCustomerId;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setCardProductClass(string $cardProductClass): self
    {
        $this->cardProductClass = $cardProductClass;
        return $this;
    }

    public function getCardProductClass(): string
    {
        return $this->cardProductClass;
    }

    public function setValidUntil(string $validUntil): self
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    public function getValidUntil(): string
    {
        return $this->validUntil;
    }

    public function setIssueNumber(string $issueNumber): self
    {
        $this->issueNumber = $issueNumber;
        return $this;
    }

    public function getIssueNumber(): string
    {
        return $this->issueNumber;
    }

    /**
     * @param array<Links> $links
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return array<Links>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    public function addLink(Links $links): self
    {
        if (!$this->getLinks()) {
            return $this->setLinks([$links]);
        }

        return $this->setLinks(
            [...$this->getLinks(), $links]
        );
    }

    public function removeLink(Links $links): self
    {
        return $this->setLinks(
            array_diff($this->getLinks(), [$links])
        );
    }
}
