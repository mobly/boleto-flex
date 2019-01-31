<?php

require __DIR__ . '/vendor/autoload.php';

use Mobly\Boletoflex\Sdk\Client;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Entities\Address;
use Mobly\Boletoflex\Sdk\Entities\Payment;
use Mobly\Boletoflex\Sdk\Transactions\VerifyFundingStatus;

$client = new Client();

// Verify status
$verifyFundingStatusTransaction = new VerifyFundingStatus();
$idTransaction = 'd9922315-5c39-3b4a-bb79-77056c1a2f97';
$verifyFundingStatusTransaction->setIdTransaction($idTransaction);

try {
    $response = $client->verifyFundingStatus($verifyFundingStatusTransaction);
    echo $response->getStatusCode();
    echo $response->getBody();

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}

// Pre Approval
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
    echo $response->getStatusCode();
    echo $response->getBody();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}






































