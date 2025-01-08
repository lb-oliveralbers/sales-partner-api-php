<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class CustomerMove implements \JsonSerializable
{
    private \DateTimeInterface $moveInDate;
    private ?bool $firstCustomerAtMarketLocation = null;

    public function setMoveInDate(\DateTimeInterface $moveInDate): self
    {
        $this->moveInDate = $moveInDate;
        return $this;
    }

    public function setFirstCustomerAtMarketLocation(?bool $firstCustomerAtMarketLocation): self
    {
        $this->firstCustomerAtMarketLocation = $firstCustomerAtMarketLocation;
        return $this;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'moveInDate' => $this->moveInDate->format('Y-m-d'),
            'firstCustomerAtMarketLocation' => $this->firstCustomerAtMarketLocation,
        ];
    }
}