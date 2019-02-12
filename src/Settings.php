<?php

namespace Mobly\Boletoflex\Sdk;

use Mobly\Boletoflex\Sdk\Entities\Cart;
use Mobly\Boletoflex\Sdk\Entities\CartItem;
use Mobly\Boletoflex\Sdk\Entities\History;
use Mobly\Boletoflex\Sdk\Entities\HistoryItem;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use Mobly\Boletoflex\Sdk\Transactions\Transaction;
use Mobly\Boletoflex\Sdk\Transactions\VerifyFundingStatus;

/**
 * @package Mobly\Boletoflex\Sdk
 *
 * @author Diego Galdino Jaldim <diego.jaldim@mobly.com.br>
 * @author Mangierre Martins <mangierre.martins@mobly.com.br>
 *
 */

class Settings implements Endpoint
{
    /**
     * @var string
     */
    protected $host;

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
}
