<?php

namespace Mobly\Boletoflex\Sdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions as GuzzleOptions;
use Mobly\Boletoflex\Sdk\Entities\Buyer;
use Mobly\Boletoflex\Sdk\Entities\Payment;
use Mobly\Boletoflex\Sdk\Entities\Shipping;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;

/**
 * Client class
 *
 * @package Mobly\Boletoflex\Sdk
 *
 * @author Diego Galdino Jaldim <diego.jaldim@mobly.com.br>
 * @author Mangierre Martins <mangierre.martins@mobly.com.br>
 *
 */

class Client
{

    /**
     * @param PreApproval $preApproval
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function preApproval(PreApproval $preApproval)
    {
        $buyer = $preApproval->getBuyer();
        $address = $preApproval->getShipping()->getAddress();
        $payment = $preApproval->getPayment();

        $client = new GuzzleClient();
        $response = $client->request(
            'POST',
            'https://api-checkout.vality.com.br/transactions/qualify',
            [
                GuzzleOptions::JSON => [
                    'buyer' => [
                        'cpf' => $buyer->getCpf()
                    ],
                    'shipping' => [
                        'address' => [
                            'city' => $address->getCity(),
                            'state' => $address->getState(),
                            'zip' => $address->getZip()
                        ]
                    ],
                    'payment' => [
                        'amount' => $payment->getAmount()
                    ]
                ]
            ]
        );

        return $response;
    }

}

























