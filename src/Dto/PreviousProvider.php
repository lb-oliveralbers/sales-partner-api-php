<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class PreviousProvider implements \JsonSerializable
{
    private ?string $name = null;
    private ?string $codeNumber = null;
    private ?string $customerNumber = null;

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setCodeNumber(?string $codeNumber): self
    {
        $this->codeNumber = $codeNumber;
        return $this;
    }

    public function setCustomerNumber(?string $customerNumber): self
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'codeNumber' => $this->codeNumber,
            'customerNumber' => $this->customerNumber,
        ];
    }
}