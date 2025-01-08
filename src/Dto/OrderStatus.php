<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

class OrderStatus implements \JsonSerializable
{
    private string $id;
    private ?string $contractId;
    private string $externalOrderId;
    private string $status;
    private ?string $statusDescription;
    private \DateTimeInterface $createdAt;
    private \DateTimeInterface $updatedAt;

    public function __construct(string $json)
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $this->id = $data['id'];
        $this->contractId = $data['contractId'] ?? null;
        $this->externalOrderId = $data['externalOrderId'];
        $this->status = $data['status'];
        $this->statusDescription = $data['statusDescription'] ?? null;
        $this->createdAt = new \DateTimeImmutable($data['createdAt']);
        $this->updatedAt = new \DateTimeImmutable($data['updatedAt']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContractId(): ?string
    {
        return $this->contractId;
    }

    public function getExternalOrderId(): string
    {
        return $this->externalOrderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusDescription(): string
    {
        return $this->statusDescription;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'contractId' => $this->contractId,
            'externalOrderId' => $this->externalOrderId,
            'status' => $this->status,
            'statusDescription' => $this->statusDescription,
            'createdAt' => $this->createdAt->format(\DateTime::ATOM),
            'updatedAt' => $this->updatedAt->format(\DateTime::ATOM),
        ];
    }
}