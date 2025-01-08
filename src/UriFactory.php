<?php

namespace LichtBlick\SalesPartner;

use GuzzleHttp\Psr7\Uri;

class UriFactory
{
    public function __construct(
        readonly Environment $environment,
        readonly string      $version = '1.0'
    )
    {
    }

    public function getOrderDataBaseUri(): Uri
    {
        return match ($this->environment) {
            Environment::PRODUCTION => new Uri('https://sales-partner-api.lichtblick.app/' . $this->version . '/'),
            Environment::TEST => new Uri('https://sales-partner-api.lichtblick-testapps.de/' . $this->version . '/')
        };
    }

    public function getUploaderBaseUri(): Uri
    {
        return match ($this->environment) {
            Environment::PRODUCTION => new Uri('https://file-upload.lichtblick.de/'),
            Environment::TEST => new Uri('https://file-upload-test.lichtblick.de/')
        };
    }
}