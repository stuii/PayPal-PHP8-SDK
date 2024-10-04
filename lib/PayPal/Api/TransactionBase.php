<?php

namespace PayPal\Api;

class TransactionBase extends CartBase
{
    /**
     * @var array<RelatedResources> $relatedResources
     */
    private array $relatedResources = [];

    /**
     * @param array<RelatedResources> $relatedResources
     */
    public function setRelatedResources(array $relatedResources): self
    {
        $this->relatedResources = $relatedResources;
        return $this;
    }

    /**
     * @return array<RelatedResources>
     */
    public function getRelatedResources(): array
    {
        return $this->relatedResources;
    }

}
