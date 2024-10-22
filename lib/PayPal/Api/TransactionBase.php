<?php

namespace PayPal\Api;

class TransactionBase extends CartBase
{
    /**
     * @var array<\PayPal\Api\RelatedResources> $relatedResources
     */
    private array $relatedResources = [];

    /**
     * @param array<\PayPal\Api\RelatedResources> $relatedResources
     */
    public function setRelatedResources(array $relatedResources): self
    {
        $this->relatedResources = $relatedResources;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\RelatedResources>
     */
    public function getRelatedResources(): array
    {
        return $this->relatedResources;
    }

}
