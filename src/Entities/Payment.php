<?php

namespace Mobly\Boletoflex\Sdk\Entities;


class Payment
{

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var float
     */
    protected $discount;

    /**
     * @var float
     */
    protected $cart;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return float
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param float $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

}