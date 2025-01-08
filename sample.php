<?php declare(strict_types=1);

use GuzzleHttp\Psr7\Utils;
use LichtBlick\SalesPartner\Client;
use LichtBlick\SalesPartner\Dto\Bonus;
use LichtBlick\SalesPartner\Dto\CorrespondenceAddress;
use LichtBlick\SalesPartner\Dto\DeliveryAddress;
use LichtBlick\SalesPartner\Dto\DirectDebit;
use LichtBlick\SalesPartner\Dto\InvoiceAddress;
use LichtBlick\SalesPartner\Dto\Order;
use LichtBlick\SalesPartner\Dto\PaymentMethod;
use LichtBlick\SalesPartner\Dto\Privileges;
use LichtBlick\SalesPartner\Dto\Salutation;
use LichtBlick\SalesPartner\Dto\Usage;
use LichtBlick\SalesPartner\Environment;

require_once __DIR__ . '/vendor/autoload.php';

// Load credentials from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (empty($_ENV['SALES_PARTNER_CLIENT_ID']) ||
    empty($_ENV['SALES_PARTNER_CLIENT_SECRET']) ||
    empty($_ENV['SALES_PARTNER_UPLOAD_REALM'])) {

    echo 'Please provide the required environment variables in a .env file.' . PHP_EOL;
    exit(1);
}

$orderId = '20250108001';
// Note: this is not a real person and randomly generated, but valid looking data
$order = (new Order())
    ->setExternalOrderId($orderId)
    ->setSignatureDate((new DateTime())->sub(new DateInterval('P1D')))
    ->setContractIsCancelledByCustomer(false)
    ->setProduct('PP_S_12_1')
    ->setInvoiceAddress((new InvoiceAddress())
        ->setSalutation(Salutation::HERR)
        ->setFirstName('Freya')
        ->setLastName('Rücker')
        ->setStreet('Mühlweg')
        ->setStreetNumber('10')
        ->setZipCode('06179')
        ->setCity('Teutschenthal')
        ->setEmail('FreyaRucker1951@email.test')
    )
    ->setDeliveryAddress((new DeliveryAddress())
        ->setMeterId('12345678')
    )
    ->setPaymentMethod(PaymentMethod::DIRECT_DEBIT)
    ->setEstimatedUsage((new Usage())
        ->setYearly(1000)
    )
    ->setCorrespondenceAddress((new CorrespondenceAddress())
        ->setSalutation(Salutation::DIVERS)
        ->setFirstName('Freya')
        ->setLastName('Rücker')
    )
    ->setBankAccount((new DirectDebit())
        ->setIban('DE17503200001399441318')
    )
    ->setPrivileges((new Privileges())
        ->setPara22EnFG(false)
    )
    ->setBonus((new Bonus())
        ->setInstantBonus(50.0)
        ->setCustomerBonus(100.0)
    );

$client = new Client(
    environment: Environment::TEST,
    clientId: $_ENV['SALES_PARTNER_CLIENT_ID'],
    clientSecret: $_ENV['SALES_PARTNER_CLIENT_SECRET'],
    uploadRealm: $_ENV['SALES_PARTNER_UPLOAD_REALM']
);

// Log in to the API, you could pass a cached token here
$client->authenticate();
echo 'Logged in with token ' . $client->getAuthToken() . PHP_EOL;

echo 'Submitting order ' . $orderId . '...' . PHP_EOL;
$result = $client->sendOrder($order);
echo 'Order ' . $result->getExternalOrderId() . ' was submitted. State ' . $result->getStatus() . PHP_EOL;

$stream = Utils::streamFor(base64_decode('JVBERi0xLjEKJcKlwrHDqwoKMSAwIG9iagogIDw8IC9UeXBlIC9DYXRhbG9nCiAgICAgL1BhZ2VzIDIgMCBSCiAgPj4KZW5kb2JqCgoyIDAgb2JqCiAgPDwgL1R5cGUgL1BhZ2VzCiAgICAgL0tpZHMgWzMgMCBSXQogICAgIC9Db3VudCAxCiAgICAgL01lZGlhQm94IFswIDAgMzAwIDE0NF0KICA+PgplbmRvYmoKCjMgMCBvYmoKICA8PCAgL1R5cGUgL1BhZ2UKICAgICAgL1BhcmVudCAyIDAgUgogICAgICAvUmVzb3VyY2VzCiAgICAgICA8PCAvRm9udAogICAgICAgICAgIDw8IC9GMQogICAgICAgICAgICAgICA8PCAvVHlwZSAvRm9udAogICAgICAgICAgICAgICAgICAvU3VidHlwZSAvVHlwZTEKICAgICAgICAgICAgICAgICAgL0Jhc2VGb250IC9UaW1lcy1Sb21hbgogICAgICAgICAgICAgICA+PgogICAgICAgICAgID4+CiAgICAgICA+PgogICAgICAvQ29udGVudHMgNCAwIFIKICA+PgplbmRvYmoKCjQgMCBvYmoKICA8PCAvTGVuZ3RoIDU1ID4+CnN0cmVhbQogIEJUCiAgICAvRjEgMTggVGYKICAgIDAgMCBUZAogICAgKEhlbGxvIFdvcmxkKSBUagogIEVUCmVuZHN0cmVhbQplbmRvYmoKCnhyZWYKMCA1CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAxOCAwMDAwMCBuIAowMDAwMDAwMDc3IDAwMDAwIG4gCjAwMDAwMDAxNzggMDAwMDAgbiAKMDAwMDAwMDQ1NyAwMDAwMCBuIAp0cmFpbGVyCiAgPDwgIC9Sb290IDEgMCBSCiAgICAgIC9TaXplIDUKICA+PgpzdGFydHhyZWYKNTY1CiUlRU9GCg=='));
// or you can pass a file:
// $pdfDocument = fopen('/path/to/sample.pdf', 'r');
// $stream = Utils::streamFor($pdfDocument);
// fclose($pdfDocument);

$filename = $orderId . '.pdf';
echo 'Uploading document ' . $filename . ' ...' . PHP_EOL;
$result = $client->uploadDocument($filename, $stream);
echo 'File upload successful? ' . ($result ? 'Yes' : 'No') . PHP_EOL;

echo 'Waiting a while for upload to process, then requesting status...';
for ($i = 0; $i < 180; $i++) {
    sleep(1);
    echo '.';
}
echo PHP_EOL;

$result = $client->getStatus($orderId);
echo 'Order ' . $result->getExternalOrderId() . ' state: ' . $result->getStatus() . PHP_EOL;