<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class HyperSchema extends PayPalModel
{
    private ?string $fragmentResolution = null;
    private bool $readonly = false;
    private ?string $contentEncoding = null;
    private ?string $pathStart = null;
    private ?string $mediaType = null;

    public function setFragmentResolution(string $fragmentResolution): self
    {
        $this->fragmentResolution = $fragmentResolution;
        return $this;
    }

    public function getFragmentResolution(): ?string
    {
        return $this->fragmentResolution;
    }

    public function setReadonly(bool $readonly): self
    {
        $this->readonly = $readonly;
        return $this;
    }

    public function getReadonly(): bool
    {
        return $this->readonly;
    }

    public function setContentEncoding(string $contentEncoding): self
    {
        $this->contentEncoding = $contentEncoding;
        return $this;
    }

    public function getContentEncoding(): ?string
    {
        return $this->contentEncoding;
    }

    public function setPathStart(string $pathStart): self
    {
        $this->pathStart = $pathStart;
        return $this;
    }

    public function getPathStart(): string
    {
        return $this->pathStart;
    }

    public function setMediaType(string $mediaType)
    {
        $this->mediaType = $mediaType;
        return $this;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

}
