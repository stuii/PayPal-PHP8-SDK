<?php

namespace PayPal\Api;

class Address extends BaseAddress
{
    private string $phone;

    private string $type;

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
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
}
