<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class Patch extends PayPalModel
{
    private string $op;

    private string $path;

    private mixed $value;

    private string $from;


    public function setOp(string $op): self
    {
        $this->op = $op;
        return $this;
    }

    public function getOp(): string
    {
        return $this->op;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

}
