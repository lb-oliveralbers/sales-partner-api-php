<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner\Dto;

enum Salutation: string
{
    case HERR = 'Herr';
    case FRAU = 'Frau';
    case DIVERS = 'Divers';
    case FAMILIE = 'Familie';
    case FIRMA = 'Firma';
}