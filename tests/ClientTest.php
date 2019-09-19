<?php

namespace Mobly\Boletoflex\Tests;

use Mobly\Boletoflex\Sdk\Client;
use Mobly\Boletoflex\Sdk\Entities\Address;
use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Cart;
use Mobly\Boletoflex\Sdk\Entities\CartItem;
use Mobly\Boletoflex\Sdk\Entities\EmptyEntity;
use Mobly\Boletoflex\Sdk\Entities\Payment;
use Mobly\Boletoflex\Sdk\Entities\Seller;
use Mobly\Boletoflex\Sdk\Entities\Service;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Transactions\Transaction;
use PHPUnit\Framework\TestCase;

/**
 * Class Client
 * @package Mobly\Boletoflex\Tests
 */
class ClientTest extends TestCase
{
    public function testTransaction()
    {
        $client = new Client('http://my-host.com');
        $client->setClient(
            $this->getGuzzleClietMock()
        );

        $shipping = new Shipping();
        $shipping->setAddress(new Address());

        $payment = new Payment();
        $payment->addService(
            new Service
        );

        $cart = new Cart();
        $cart->addItem(
            new CartItem()
        );

        $transaction = new Transaction();
        $transaction->setShipping($shipping);
        $transaction->setSeller(
            new Seller()
        );
        $transaction->setBuyer(
            new Buyer()
        );
        $transaction->setHistory(
            new EmptyEntity()
        );
        $transaction->setPayment($payment);
        $transaction->setCart($cart);
        $client->transaction($transaction);

    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\GuzzleHttp\Client
     */
    private function getGuzzleClietMock()
    {
        $mock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $mock->expects($this->once())
            ->method('request');

        return $mock;
    }
}
