<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class DeliveryAddress implements \JsonSerializable
{
    private ?string $street = null;
    private ?string $streetNumber = null;
    private ?string $zipCode = null;
    private ?string $city = null;
    private string $meterId;
    private ?string $marketLocationId = null;

    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function setStreetNumber(?string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function setMeterId(string $meterId): self
    {
        $this->meterId = $meterId;
        return $this;
    }

    public function setMarketLocationId(?string $marketLocationId): self
    {
        $this->marketLocationId = $marketLocationId;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'street' => $this->street,
            'streetNumber' => $this->streetNumber,
            'zipCode' => $this->zipCode,
            'city' => $this->city,
            'meterId' => $this->meterId,
            'marketLocationId' => $this->marketLocationId,
        ];
    }
}