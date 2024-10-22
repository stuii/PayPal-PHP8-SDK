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
    private ?string $id = null;

    private string $intent;

    private Payer $payer;

    /** @var array<\PayPal\Api\Transaction> $transactions */
    private array $transactions = [];

    private ?string $state = null;

    private ?string $noteToPayer = null;

    private ?Payee $payee = null;

    private RedirectUrls $redirectUrls;

    private ?string $failureReason = null;

    private ?string $createTime = null;

    private ?string $updateTime = null;

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
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

    public function getPayee(): ?Payee
    {
        return $this->payee;
    }

    /**
     * @param array<\PayPal\Api\Transaction> $transactions
     */
    public function setTransactions(array $transactions): self
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\Transaction>
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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setExperienceProfileId(string $experienceProfileId): self
    {
        $this->experienceProfileId = $experienceProfileId;
        return $this;
    }

    public function getExperienceProfileId(): ?string
    {
        return $this->experienceProfileId;
    }

    public function setNoteToPayer(string $noteToPayer): self
    {
        $this->noteToPayer = $noteToPayer;
        return $this;
    }

    public function getNoteToPayer(): ?string
    {
        return $this->noteToPayer;
    }

    public function setRedirectUrls(RedirectUrls $redirectUrls): self
    {
        $this->redirectUrls = $redirectUrls;
        return $this;
    }

    public function getRedirectUrls(): RedirectUrls
    {
        return $this->redirectUrls;
    }

    public function setFailureReason(string $failureReason): self
    {
        $this->failureReason = $failureReason;
        return $this;
    }

    public function getFailureReason(): ?string
    {
        return $this->failureReason;
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
