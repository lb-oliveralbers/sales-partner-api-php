<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class CorrespondenceAddress implements \JsonSerializable
{
    private ?Salutation $salutation = null;
    private string $firstName;
    private string $lastName;
    private ?string $company = null;

    public function setSalutation(?Salutation $salutation): self
    {
        $this->salutation = $salutation;
        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'salutation' => $this->salutation?->value,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'company' => $this->company,
        ];
    }
}