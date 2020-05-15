<?php

namespace Mobly\Boletoflex\Sdk\Transactions;

use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Cart;
use Mobly\Boletoflex\Sdk\Entities\History;
use Mobly\Boletoflex\Sdk\Entities\Seller;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Entities\Payment;
use Mobly\Boletoflex\Sdk\Entities\Source;

class Simulate extends AbstractTransaction
{

    /**
     * @var Buyer $buyer
     */
    protected $buyer;
    
    /**
     * @var string
     */
    protected $reference;

    /**
     * @var Seller $seller
     */
    protected $seller;

    /**
     * @var Source $source
     */
    protected $source;

    /**
     * @var Shipping $shipping
     */
    protected $shipping;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var Payment $payment;
     */
    protected $payment;

    /**
     * @var Cart $cart;
     */
    protected $cart;

    /**
     * @var History $history;
     */
    protected $history;

    /*---------------------------------------------------------------------------------------*/

    /**
     * @return Buyer
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param Buyer $buyer
     */
    public function setBuyer(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param Shipping $shipping
     */
    public function setShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param Seller $seller
     */
    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return Source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param Source $source
     */
    public function setSource(Source $source)
    {
        $this->source = $source;
    }

    /**
     * @return History
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @param History $history
     */
    public function setHistory(History $history)
    {
        $this->history = $history;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

}
