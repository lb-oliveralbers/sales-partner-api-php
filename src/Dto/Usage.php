<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class Usage implements \JsonSerializable
{
    private int $yearly;
    private ?int $yearlyNT = null;

    public function setYearly(int $yearly): self
    {
        $this->yearly = $yearly;
        return $this;
    }

    public function setYearlyNT(?int $yearlyNT): self
    {
        $this->yearlyNT = $yearlyNT;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'yearly' => $this->yearly,
            'yearlyNT' => $this->yearlyNT,
        ];
    }
}