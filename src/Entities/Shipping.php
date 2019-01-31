<?php

namespace Mobly\Boletoflex\Sdk\Entities;


class Shipping
{

    /** @var Address $address */
    protected $address;

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }



}