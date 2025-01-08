<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class DirectDebit implements \JsonSerializable
{
    private ?string $accountHolderFirstName = null;
    private ?string $accountHolderLastName = null;
    private ?string $bankName = null;
    private string $iban;

    public function setAccountHolderFirstName(?string $accountHolderFirstName): self
    {
        $this->accountHolderFirstName = $accountHolderFirstName;
        return $this;
    }

    public function setAccountHolderLastName(?string $accountHolderLastName): self
    {
        $this->accountHolderLastName = $accountHolderLastName;
        return $this;
    }

    public function setBankName(?string $bankName): self
    {
        $this->bankName = $bankName;
        return $this;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'accountHolderFirstName' => $this->accountHolderFirstName,
            'accountHolderLastName' => $this->accountHolderLastName,
            'bankName' => $this->bankName,
            'iban' => $this->iban,
        ];
    }
}