<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class InvoiceAddress implements \JsonSerializable
{
    private ?Salutation $salutation = null;
    private ?string $title = null;
    private string $firstName;
    private string $lastName;
    private ?string $company = null;
    private string $street;
    private string $streetNumber;
    private string $zipCode;
    private string $city;
    private ?string $phone = null;
    private string $email;

    public function setSalutation(?Salutation $salutation): self
    {
        $this->salutation = $salutation;
        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
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

    public function setStreet(string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'salutation' => $this->salutation->value,
            'title' => $this->title,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'company' => $this->company,
            'street' => $this->street,
            'streetNumber' => $this->streetNumber,
            'zipCode' => $this->zipCode,
            'city' => $this->city,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}