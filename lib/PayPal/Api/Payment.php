<?php

namespace PayPal\Api;

use JsonException;
use PayPal\Common\PayPalResourceModel;
use PayPal\Core\PayPalConstants;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;
use PayPal\Validation\ArgumentValidator;
use ReflectionException;

class Payment extends PayPalResourceModel
{
    private string $id;

    private string $intent;

    private Payer $payer;

    /** @var array<Transaction> $transactions */
    private array $transactions;

    private string $state;

    private string $experienceProfileId;

    private string $noteToPayer;

    private Payee $payee;

    private RedirectUrls $redirect_urls;

    private string $failureReason;

    private string $createTime;

    private string $updateTime;

    /** @var array<Links> $links */
    public array $links;

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setIntent(string $intent): self
    {
        $this->intent = $intent;
        return $this;
    }

    public function getIntent(): string
    {
        return $this->intent;
    }

    public function setPayer(Payer $payer): self
    {
        $this->payer = $payer;
        return $this;
    }

    public function getPayer(): Payer
    {
        return $this->payer;
    }

    public function setPayee(Payee $payee): self
    {
        $this->payee = $payee;
        return $this;
    }

    public function getPayee(): Payee
    {
        return $this->payee;
    }

    /**
     * @param array<Transaction> $transactions
     */
    public function setTransactions(array $transactions): self
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @return array<Transaction>
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->getTransactions()) {
            return $this->setTransactions([$transaction]);
        }

        return $this->setTransactions(
            [...$this->getTransactions(), $transaction]
        );
    }

    public function removeTransaction(Transaction $transaction): self
    {
        return $this->setTransactions(
            array_diff($this->getTransactions(), [$transaction])
        );
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

    public function setExperienceProfileId(string $experienceProfileId): self
    {
        $this->experienceProfileId = $experienceProfileId;
        return $this;
    }

    public function getExperienceProfileId(): string
    {
        return $this->experienceProfileId;
    }

    public function setNoteToPayer(string $noteToPayer): self
    {
        $this->noteToPayer = $noteToPayer;
        return $this;
    }

    public function getNoteToPayer(): string
    {
        return $this->noteToPayer;
    }

    public function setRedirectUrls(RedirectUrls $redirect_urls): self
    {
        $this->redirect_urls = $redirect_urls;
        return $this;
    }

    public function getRedirectUrls(): RedirectUrls
    {
        return $this->redirect_urls;
    }

    public function setFailureReason(string $failureReason): self
    {
        $this->failureReason = $failureReason;
        return $this;
    }

    public function getFailureReason(): string
    {
        return $this->failureReason;
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

    public function getApprovalLink(): ?string
    {
        return $this->getLink(PayPalConstants::APPROVAL_URL);
    }

    public function getToken(): ?string
    {
        $parameter_name = 'token';
        parse_str(parse_url($this->getApprovalLink(), PHP_URL_QUERY), $query);
        return $query[$parameter_name] ?? null;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws ReflectionException
     * @throws JsonException
     */
    public function create(ApiContext $apiContext = null, PayPalRestCall $restCall = null): Payment
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            '/v1/payments/payment',
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
    public static function get(
        string $paymentId,
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null
    ): Payment {
        ArgumentValidator::validate($paymentId, 'paymentId');
        $payload = '';
        $json = self::executeCall(
            '/v1/payments/payment/' . $paymentId,
            'GET',
            $payload,
            null,
            $apiContext,
            $restCall
        );
        $ret = new Payment();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     */
    public function update(
        PatchRequest $patchRequest,
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null
    ): bool {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($patchRequest, 'patchRequest');
        $payLoad = $patchRequest->toJSON();
        self::executeCall(
            '/v1/payments/payment/' . $this->getId(),
            'PATCH',
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
    public function execute(
        PaymentExecution $paymentExecution,
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null
    ): Payment {
        ArgumentValidator::validate($this->getId(), 'Id');
        ArgumentValidator::validate($paymentExecution, 'paymentExecution');
        $payLoad = $paymentExecution->toJSON();
        $json = self::executeCall(
            '/v1/payments/payment/' . $this->getId() . '/execute',
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
    public static function all(
        array $params,
        ?ApiContext $apiContext = null,
        ?PayPalRestCall $restCall = null
    ): PaymentHistory {
        ArgumentValidator::validate($params, 'params');
        $payload = '';
        $allowedParams = [
            'count' => 1,
            'start_id' => 1,
            'start_index' => 1,
            'start_time' => 1,
            'end_time' => 1,
            'payee_id' => 1,
            'sort_by' => 1,
            'sort_order' => 1,
        ];
        $json = self::executeCall(
            '/v1/payments/payment?' . http_build_query(array_intersect_key($params, $allowedParams)),
            'GET',
            $payload,
            null,
            $apiContext,
            $restCall
        );
        $ret = new PaymentHistory();
        $ret->fromJson($json);
        return $ret;
    }
}
