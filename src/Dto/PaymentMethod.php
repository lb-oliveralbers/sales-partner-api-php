<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

enum PaymentMethod: string
{
    case DIRECT_DEBIT = 'directDebit';
    case INVOICE = 'invoice';
}