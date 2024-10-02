<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class ItemList extends PayPalModel
{
    /** @var array<\PayPal\Api\Item> $items */
    private array $items = [];

    private ?ShippingAddress $shippingAddress = null;

    private ?string $shippingMethod = null;

    private ?string $shippingPhoneNumber = null;

    /**
     * @param array<Item> $items
     */
    public function setItems(array $items): self
    {
        $this->items = array_values($items);
        return $this;
    }

    /**
     * @return array<Item>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->getItems()) {
            return $this->setItems([$item]);
        }

        return $this->setItems(
            array_merge([...$this->getItems(), $item])
        );
    }

    public function removeItem(Item $item): self
    {
        return $this->setItems(
            array_diff($this->getItems(), [$item])
        );
    }

    public function setShippingAddress(ShippingAddress $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingAddress(): ?ShippingAddress
    {
        return $this->shippingAddress;
    }

    public function setShippingMethod(string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingPhoneNumber(string $shippingPhoneNumber): self
    {
        $this->shippingPhoneNumber = $shippingPhoneNumber;
        return $this;
    }

    public function getShippingPhoneNumber(): ?string
    {
        return $this->shippingPhoneNumber;
    }

}
