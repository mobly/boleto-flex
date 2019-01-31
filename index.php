<?php

require __DIR__ . '/vendor/autoload.php';

use Mobly\Boletoflex\Sdk\Client;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Entities\Address;
use Mobly\Boletoflex\Sdk\Entities\Payment;

$client = new Client();

$preApprovalTransaction = new PreApproval();

$buyer = new Buyer();
$buyer->setCpf('21846764890');

$address = new Address();
$address->setCity('Florianópolis');
$address->setState('SC');
$address->setZip('88034480');

$shipping = new Shipping();
$shipping->setAddress($address);

$payment = new Payment();
$payment->setAmount(1500.00);

$preApprovalTransaction->setBuyer($buyer);
$preApprovalTransaction->setShipping($shipping);
$preApprovalTransaction->setPayment($payment);

try {
    $response = $client->preApproval($preApprovalTransaction);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}
echo $response->getStatusCode();
echo $response->getBody();






































