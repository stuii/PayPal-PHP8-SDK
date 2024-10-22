<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

class PatchRequest extends PayPalModel
{
    /** @var array<\PayPal\Api\Patch> $patches */
    private array $patches;

    /**
     * @param array<\PayPal\Api\Patch> $patches
     */
    public function setPatches(array $patches): self
    {
        $this->patches = $patches;
        return $this;
    }

    /**
     * @return array<\PayPal\Api\Patch>
     */
    public function getPatches(): array
    {
        return $this->patches;
    }

    public function addPatch(Patch $patch): self
    {
        if (!$this->getPatches()) {
            return $this->setPatches([$patch]);
        }

        return $this->setPatches(
            [...$this->getPatches(), $patch]
        );
    }

    public function removePatch(Patch $patch): self
    {
        return $this->setPatches(
            array_diff($this->getPatches(), [$patch])
        );
    }

    public function toJSON(int $options = 0): string
    {
        $json = [];
        foreach ($this->getPatches() as $patch) {
            $json[] = $patch->toArray();
        }
        return str_replace('\\/', '/', json_encode($json, JSON_THROW_ON_ERROR | $options));
    }
}
