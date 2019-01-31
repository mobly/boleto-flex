<?php

namespace Mobly\Boletoflex\Sdk\Entities;


class Payment
{

    /**
     * @var float $amount
     */
    protected $amount;

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

}