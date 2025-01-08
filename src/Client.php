<?php declare(strict_types=1);

namespace LichtBlick\SalesPartner;

use LichtBlick\SalesPartner\Dto\Order;
use LichtBlick\SalesPartner\Dto\OrderStatus;
use Psr\Http\Message\StreamInterface;

class Client
{
    public const string LICHTBLICK_ENTRA_TENANT = 'a6238551-92a6-4d9a-90fa-3f16b12dc7c3';

    private string $authToken = '';

    public function __construct(
        readonly Environment $environment,
        readonly string      $clientId,
        readonly string      $clientSecret,
        readonly string      $uploadRealm,
        readonly string      $entraIdTenantId = self::LICHTBLICK_ENTRA_TENANT
    )
    {
    }

    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public function authenticate(?string $token = null): self
    {
        if (!empty($token)) {
            $this->authToken = $token;
            return $this;
        }

        $uriFactory = new UriFactory($this->environment);
        $resource = $uriFactory->getOrderDataBaseUri()->withPath('/');

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://login.microsoftonline.com/a6238551-92a6-4d9a-90fa-3f16b12dc7c3/oauth2/token/', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'resource' => (string)$resource
            ],
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        if (!$response->getStatusCode() == 200) {
            throw new \Exception('Authentication failed');
        }

        $response = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        if (!$response->expires_on || $response->expires_on < time()) {
            throw new \Exception('Authentication expired');
        }

        if (!$response->access_token) {
            throw new \Exception('Authentication failed');
        }

        $this->authToken = $response->access_token;

        return $this;
    }

    public function sendOrder(Order $order): OrderStatus
    {
        $client = new \GuzzleHttp\Client();

        $uriFactory = new UriFactory($this->environment);

        $response = $client->request(
            'POST',
            (string)$uriFactory->getOrderDataBaseUri()->withPath($uriFactory->version . '/orders'),
            [
                'body' => json_encode($order),
                'headers' => [
                    'authorization' => 'Bearer ' . $this->authToken,
                    'content-type' => 'application/json',
                ],
                'http_errors' => false
            ]
        );

        if ($response->getStatusCode() == 409) {
            throw new \Exception('Order already exists');
        }

        if ($response->getStatusCode() == 403) {
            throw new \Exception('Forbidden - Probably issue with LichtBlick WAF');
        }

        if ($response->getStatusCode() == 401) {
            throw new \Exception('Unauthorized');
        }

        if ($response->getStatusCode() == 400) {
            throw new \Exception('Bad request: ' . $response->getBody()->getContents());
        }

        if ($response->getStatusCode() == 201) {
            return new OrderStatus($response->getBody()->getContents());
        }

        throw new \Exception('Unknown error');
    }

    public function getStatus(string $externalOrderId): OrderStatus
    {
        $client = new \GuzzleHttp\Client();

        $uriFactory = new UriFactory($this->environment);

        $response = $client->request(
            'GET',
            (string)$uriFactory->getOrderDataBaseUri()->withPath($uriFactory->version . '/orders/' . $externalOrderId . '/status'),
            [
                'headers' => [
                    'authorization' => 'Bearer ' . $this->authToken,
                    'content-type' => 'application/json',
                ],
                'http_errors' => false
            ]
        );

        if ($response->getStatusCode() == 404) {
            throw new \Exception('Order not found');
        }

        if ($response->getStatusCode() == 403) {
            throw new \Exception('Forbidden - Probably issue with LichtBlick WAF');
        }

        if ($response->getStatusCode() == 401) {
            throw new \Exception('Unauthorized');
        }

        if ($response->getStatusCode() == 400) {
            throw new \Exception('Bad request: ' . $response->getBody()->getContents());
        }

        if ($response->getStatusCode() == 200) {
            return new OrderStatus($response->getBody()->getContents());
        }

        throw new \Exception('Unknown error');
    }

    public function uploadDocument(string $filename, StreamInterface $content): bool
    {
        $client = new \GuzzleHttp\Client();

        $uriFactory = new UriFactory($this->environment);

        $response = $client->request(
            'POST',
            (string)$uriFactory->getUploaderBaseUri()->withPath('/upload/realms/' . $this->uploadRealm),
            [
                'multipart' => [
                    [
                        'name' => 'file',
                        'filename' => $filename,
                        'contents' => $content->getContents()
                    ]
                ],
            ]
        );

        if ($response->getStatusCode() == 403) {
            throw new \Exception('Forbidden - Probably issue with LichtBlick WAF');
        }

        if ($response->getStatusCode() == 201) {
            return true;
        }

        return false;
    }
}