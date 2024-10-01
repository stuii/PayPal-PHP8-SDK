<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;

class CreditCardList extends PayPalResourceModel
{
    /** @var array<\PayPal\Api\CreditCard> $items */
    private array $items = [];

    private int $totalItems = 0;

    private int $totalPages = 0;

    /**
     * @param array<CreditCard> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return array<CreditCard> $items
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(CreditCard $creditCard): self
    {
        if (!$this->getItems()) {
            return $this->setItems([$creditCard]);
        }

        return $this->setItems(
            [...$this->getItems(), $creditCard]
        );
    }

    public function removeItem(CreditCard $creditCard): self
    {
        return $this->setItems(
            array_diff($this->getItems(), [$creditCard])
        );
    }

    public function setTotalItems(int $totalItems): self
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
