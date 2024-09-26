<?php /** @noinspection ALL */

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class Links extends PayPalModel
{
    public string $href;

    public string $rel;

    public HyperSchema $targetSchema;

    public string $method;

    public string $enctype;

    public HyperSchema $schema;

    public function setHref(string $href): self
    {
        $this->href = $href;
        return $this;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function setRel(string $rel): self
    {
        $this->rel = $rel;
        return $this;
    }

    public function getRel(): string
    {
        return $this->rel;
    }

    public function setTargetSchema(HyperSchema $targetSchema): self
    {
        $this->targetSchema = $targetSchema;
        return $this;
    }

    public function getTargetSchema(): HyperSchema
    {
        return $this->targetSchema;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setEnctype(string $enctype): self
    {
        $this->enctype = $enctype;
        return $this;
    }

    public function getEnctype(): string
    {
        return $this->enctype;
    }

    public function setSchema(HyperSchema $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    public function getSchema(): HyperSchema
    {
        return $this->schema;
    }
}
