<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class FmfDetails extends PayPalModel
{
    private string $filterType;

    private string $filterId;

    private string $name;

    private string $description;


    public function setFilterType(string $filterType): self
    {
        $this->filterType = $filterType;
        return $this;
    }

    public function getFilterType(): string
    {
        return $this->filterType;
    }

    public function setFilterId(string $filterId): self
    {
        $this->filterId = $filterId;
        return $this;
    }

    public function getFilterId(): string
    {
        return $this->filterId;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
