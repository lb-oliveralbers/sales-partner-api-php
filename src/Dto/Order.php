<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

use LichtBlick\SalesPartner\Dto\PaymentMethod;

class Order implements \JsonSerializable
{
    private string $externalOrderId;
    private ?string $campaignId = null;
    private string $product;
    private \DateTimeInterface $signatureDate;
    private ?\DateTimeInterface $deliveryStartDate = null;
    private bool $contractIsCancelledByCustomer;
    private ?\DateTimeInterface $cancellationDatePreviousProvider = null;
    private InvoiceAddress $invoiceAddress;
    private ?CorrespondenceAddress $correspondenceAddress = null;
    private DeliveryAddress $deliveryAddress;
    private PaymentMethod $paymentMethod;
    private ?DirectDebit $bankAccount = null;
    private ?CustomerMove $customerMoving = null;
    private ?PreviousProvider $previousProvider = null;
    private Usage $estimatedUsage;
    private ?string $contractDocumentFileName = null;
    private ?Bonus $bonus = null;
    private ?bool $optin = null;
    private ?LBCustomer $lbCustomer = null;
    private ?string $statusWebhook = null;
    private ?string $commissionRecipientId = null;
    private ?\DateTimeInterface $customerBirthDate = null;
    private ?Privileges $privileges = null;

    public function setExternalOrderId(string $externalOrderId): self
    {
        $this->externalOrderId = $externalOrderId;
        return $this;
    }

    public function setCampaignId(?string $campaignId): self
    {
        $this->campaignId = $campaignId;
        return $this;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function setSignatureDate(\DateTimeInterface $signatureDate): self
    {
        $this->signatureDate = $signatureDate;
        return $this;
    }

    public function setDeliveryStartDate(?\DateTimeInterface $deliveryStartDate): self
    {
        $this->deliveryStartDate = $deliveryStartDate;
        return $this;
    }

    public function setContractIsCancelledByCustomer(bool $contractIsCancelledByCustomer): self
    {
        $this->contractIsCancelledByCustomer = $contractIsCancelledByCustomer;
        return $this;
    }

    public function setCancellationDatePreviousProvider(?\DateTimeInterface $cancellationDatePreviousProvider): self
    {
        $this->cancellationDatePreviousProvider = $cancellationDatePreviousProvider;
        return $this;
    }

    public function setInvoiceAddress(InvoiceAddress $invoiceAddress): self
    {
        $this->invoiceAddress = $invoiceAddress;
        return $this;
    }

    public function setCorrespondenceAddress(?CorrespondenceAddress $correspondenceAddress): self
    {
        $this->correspondenceAddress = $correspondenceAddress;
        return $this;
    }

    public function setDeliveryAddress(DeliveryAddress $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function setBankAccount(?DirectDebit $bankAccount): self
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function setCustomerMoving(?CustomerMove $customerMoving): self
    {
        $this->customerMoving = $customerMoving;
        return $this;
    }

    public function setPreviousProvider(?PreviousProvider $previousProvider): self
    {
        $this->previousProvider = $previousProvider;
        return $this;
    }

    public function setEstimatedUsage(Usage $estimatedUsage): self
    {
        $this->estimatedUsage = $estimatedUsage;
        return $this;
    }

    public function setContractDocumentFileName(?string $contractDocumentFileName): self
    {
        $this->contractDocumentFileName = $contractDocumentFileName;
        return $this;
    }

    public function setBonus(?Bonus $bonus): self
    {
        $this->bonus = $bonus;
        return $this;
    }

    public function setOptin(?bool $optin): self
    {
        $this->optin = $optin;
        return $this;
    }

    public function setLbCustomer(?LBCustomer $lbCustomer): self
    {
        $this->lbCustomer = $lbCustomer;
        return $this;
    }

    public function setStatusWebhook(?string $statusWebhook): self
    {
        $this->statusWebhook = $statusWebhook;
        return $this;
    }

    public function setCommissionRecipientId(?string $commissionRecipientId): self
    {
        $this->commissionRecipientId = $commissionRecipientId;
        return $this;
    }

    public function setCustomerBirthDate(?\DateTimeInterface $customerBirthDate): self
    {
        $this->customerBirthDate = $customerBirthDate;
        return $this;
    }

    public function setPrivileges(?Privileges $privileges): self
    {
        $this->privileges = $privileges;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'externalOrderId' => $this->externalOrderId,
            'campaignId' => $this->campaignId,
            'product' => $this->product,
            'signatureDate' => $this->signatureDate->format('Y-m-d'),
            'deliveryStartDate' => $this->deliveryStartDate?->format('Y-m-d'),
            'contractIsCancelledByCustomer' => $this->contractIsCancelledByCustomer,
            'cancellationDatePreviousProvider' => $this->cancellationDatePreviousProvider?->format('Y-m-d'),
            'invoiceAddress' => $this->invoiceAddress,
            'correspondenceAddress' => $this->correspondenceAddress,
            'deliveryAddress' => $this->deliveryAddress,
            'paymentMethod' => $this->paymentMethod->value,
            'bankAccount' => $this->bankAccount,
            'customerMoving' => $this->customerMoving,
            'previousProvider' => $this->previousProvider,
            'estimatedUsage' => $this->estimatedUsage,
            'contractDocumentFileName' => $this->contractDocumentFileName,
            'bonus' => $this->bonus,
            'optin' => $this->optin,
            'lbCustomer' => $this->lbCustomer,
            'statusWebhook' => $this->statusWebhook,
            'commissionRecipientId' => $this->commissionRecipientId,
            'customerBirthDate' => $this->customerBirthDate?->format('Y-m-d'),
            'privileges' => $this->privileges,
        ];
    }
}
