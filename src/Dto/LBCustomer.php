<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class LBCustomer implements \JsonSerializable
{
    private ?string $customerId = null;
    private ?string $contractId = null;

    public function setCustomerId(?string $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function setContractId(?string $contractId): self
    {
        $this->contractId = $contractId;
        return $this;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'customerId' => $this->customerId,
            'contractId' => $this->contractId,
        ];
    }
}