<?php

namespace Mobly\Boletoflex\Sdk\Transactions;


abstract class AbstractTransaction
{

    /**
     * @var string $idTransaction
     */
    protected $idTransaction;

    /**
     * @return string
     */
    public function getIdTransaction()
    {
        return $this->idTransaction;
    }

    /**
     * @param string $idTransaction
     */
    public function setIdTransaction($idTransaction)
    {
        $this->idTransaction = $idTransaction;
    }

}