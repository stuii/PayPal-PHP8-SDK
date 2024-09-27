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

class CreditCard extends PayPalResourceModel
{
    private string $number;

    private string $type;

    private int $expireMonth;

    private int $expireYear;

    private string $cvv2;

    private string $firstName;

    private string $lastName;

    private Address $billingAddress;

    private string $externalCustomerId;

    private string $state;

    private string $validUntil;

    /** @var array<Links> $links */
    public array $links;

    private string $createTime;

    private string $updateTime;

    private string $id;


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

    public function setExpireMonth(int $expireMonth): self
    {
        $this->expireMonth = $expireMonth;
        return $this;
    }

    public function getExpireMonth(): int
    {
        return $this->expireMonth;
    }

    public function setExpireYear(int $expireYear): self
    {
        $this->expireYear = $expireYear;
        return $this;
    }

    public function getExpireYear(): int
    {
        return $this->expireYear;
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

    public function setBillingAddress(Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress(): Address
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

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
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

    public function setValidUntil(string $validUntil): self
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    public function getValidUntil(): string
    {
        return $this->validUntil;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function create(?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            '/v1/vault/credit-cards',
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
    public static function get(string $creditCardId, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($creditCardId, 'creditCardId');
        $payLoad = '';
        $json = self::executeCall(
            '/v1/vault/credit-cards/' . $creditCardId,
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new CreditCard();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function delete($apiContext = null, $restCall = null): bool
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        $payLoad = '';
        self::executeCall(
            '/v1/vault/credit-cards/' . $this->getId(),
            'DELETE',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function update(PatchRequest $patchRequest, ?ApiContext $apiContext = null, ?PayPalRestCall $restCall = null): self
    {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($patchRequest, 'patch');
        $payload = $patchRequest->toJSON();
        $json = self::executeCall(
            '/v1/vault/credit-cards/' . $this->getId(),
            'PATCH',
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
    public static function all(
        ?array $params,
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null
    ): CreditCardList {
        if ($params === null) {
            $params = [];
        }
        ArgumentValidator::validate($params, 'params');
        $payLoad = '';
        $allowedParams = [
            'page_size' => 1,
            'page' => 1,
            'start_time' => 1,
            'end_time' => 1,
            'sort_order' => 1,
            'sort_by' => 1,
            'merchant_id' => 1,
            'external_card_id' => 1,
            'external_customer_id' => 1,
            'total_required' => 1
        ];
        $json = self::executeCall(
            '/v1/vault/credit-cards' . '?' . http_build_query(array_intersect_key($params, $allowedParams)),
            'GET',
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new CreditCardList();
        $ret->fromJson($json);
        return $ret;
    }
}
