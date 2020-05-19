<?php

require __DIR__ . '/vendor/autoload.php';

use Mobly\Boletoflex\Sdk\Client;
use Mobly\Boletoflex\Sdk\Entities\Source;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use \Mobly\Boletoflex\Sdk\Transactions\Simulate;
use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Entities\Address;
use Mobly\Boletoflex\Sdk\Entities\Payment;
use Mobly\Boletoflex\Sdk\Transactions\VerifyFundingStatus;
use Mobly\Boletoflex\Sdk\Transactions\Transaction;
use Mobly\Boletoflex\Sdk\Entities\Seller;
use Mobly\Boletoflex\Sdk\Entities\Cart;
use Mobly\Boletoflex\Sdk\Entities\CartItem;
use Mobly\Boletoflex\Sdk\Entities\History;
use Mobly\Boletoflex\Sdk\Entities\HistoryItem;
use Mobly\Boletoflex\Sdk\Entities\Service;

$client = new Client('https://api-checkout.vality.com.br');

// Payment transaction
$buyer = new Buyer();
$buyer->setPhoneNumber('11987654321');
$buyer->setName('Joaquim Levy');
$buyer->setCpf('46883731806');
$buyer->setEmail('joaquim@gmail.com');

$seller = new Seller();
$seller->setName('Mobly');

$address = new Address();
$address->setZip('88034480');
$address->setNumber('156');
$address->setCountry('BR');
$address->setCity('Florianópolis');
$address->setStreet('Rua Itapiranga');
$address->setDistrict('Itacorubi');
$address->setState('SC');
$address->setComplement('Bloco A Ap. 604');

$shipping = new Shipping();
$shipping->setAmount(35.00);
$shipping->setAddress($address);

$service = new Service();
$service->setDescription('Montagem');
$service->setAmount(150.00);

$payment = new Payment();
$payment->setAmount(1174.98);
$payment->setDiscount(50.00);
$payment->setCart(1189.98);
$payment->addService($service);

$cartItem = new CartItem();
$cartItem->setAmount(289.99);
$cartItem->setQuantity(1);
$cartItem->setDescription('Conjunto com 2 Cadeiras Eames Eiffel Preto Base Madeira');
$cartItem->setWeight(7.6);
$cartItem->setSku('201558');
$cartItem->setCategory('Móveis - Cadeiras de Jantar');

$cart = new Cart();
$cart->addItem($cartItem);

$historyPayment = new Payment();
$historyPayment->setAmount(1334.90);

$historyAddressShipping = new Address();
$historyAddressShipping->setZip('88034480');

$historyShipping = new Shipping();
$historyShipping->setAmount(5.00);
$historyShipping->setAddress($historyAddressShipping);

$historyCartItem = new CartItem();
$historyCartItem->setAmount(1329.90);
$historyCartItem->setQuantity(1);
$historyCartItem->setDescription('Conjunto Retrô Sidari para Banheiro com Cuba Acabamento Vermelho e Rafia');
$historyCartItem->setSku('345253');
$historyCartItem->setCategory('Móveis - Armários de Banheiro');

$historyCart = new Cart();
$historyCart->addItem($historyCartItem);

$historyItem = new HistoryItem();
$historyItem->setDate('2018-06-21T18:34:00.000Z');
$historyItem->setReference('00003354');
$historyItem->setPayment($historyPayment);
$historyItem->setShipping($historyShipping);
$historyItem->setCart($historyCart);

$history = new History();
$history->addItem($historyItem);

$source = new Source();
$source->setName('your-source');

$transaction = new Transaction();
$transaction->setReference('00004122');
$transaction->setCurrency('BRL');
$transaction->setSeller($seller);
$transaction->setCart($cart);
$transaction->setHistory($history);
$transaction->setShipping($shipping);
$transaction->setBuyer($buyer);
$transaction->setPayment($payment);
$transaction->setSource($source);

try {
    $response = $client->transaction($transaction);
    echo $response->getStatusCode();
    echo $response->getBody();
    exit;
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}

// Verify status
$verifyFundingStatusTransaction = new VerifyFundingStatus();
$idTransaction = 'd9922315-5c39-3b4a-bb79-77056c1a2f97';
$verifyFundingStatusTransaction->setIdTransaction($idTransaction);

try {
    $response = $client->verifyFundingStatus($verifyFundingStatusTransaction);
    echo $response->getStatusCode();
    echo $response->getBody();
    exit;

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}

// Pre Approval
$preApprovalTransaction = new PreApproval();
$preApprovalTransaction->setSeller($seller);

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
    exit;

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}

// Simulate
$simulate = new Simulate();
$simulate->setBuyer($buyer);
$simulate->setReference('12345');
$simulate->setSeller($seller);
$simulate->setSource($source);
$simulate->setShipping($shipping);
$simulate->setCurrency('BRL');
$simulate->setPayment($payment);
$simulate->setCart($cart);

try {
    $response = $client->simulate($simulate);
    echo $response->getStatusCode();
    echo $response->getBody();
    exit;

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    die($e->getMessage());
}
