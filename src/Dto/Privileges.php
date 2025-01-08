<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class Privileges implements \JsonSerializable
{
    private ?bool $para22EnFG = null;

    public function setPara22EnFG(?bool $para22EnFG): Privileges
    {
        $this->para22EnFG = $para22EnFG;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'para22EnFG' => $this->para22EnFG,
        ];
    }
}