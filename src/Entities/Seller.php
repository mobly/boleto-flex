<?php

namespace Mobly\Boletoflex\Sdk\Entities;

class Seller extends AbstractEntity
{

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $name
     */
    protected $paymentId;

    /**
     * @var string $name
     */
    protected $returnUrl;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }


    /**
     * @return string
     */
    public function getreturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     */
    public function setreturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }
}
