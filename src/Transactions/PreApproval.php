<?php

namespace Mobly\Boletoflex\Sdk\Transactions;

use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Entities\Payment;


class PreApproval
{

    /**
     * @var Buyer $buyer
     */
    protected $buyer;

    /**
     * @var Shipping $shipping
     */
    protected $shipping;

    /**
     * @var Payment $payment;
     */
    protected $payment;

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

}