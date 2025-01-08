<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class Bonus implements \JsonSerializable
{
    private ?float $instantBonus = null;
    private ?float $customerBonus = null;

    public function setInstantBonus(?float $instantBonus): self
    {
        $this->instantBonus = $instantBonus;
        return $this;
    }

    public function setCustomerBonus(?float $customerBonus): self
    {
        $this->customerBonus = $customerBonus;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'instantBonus' => $this->instantBonus,
            'customerBonus' => $this->customerBonus,
        ];
    }
}