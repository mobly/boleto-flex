<?php

namespace Mobly\Boletoflex\Sdk;

use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use Mobly\Boletoflex\Sdk\Transactions\VerifyFundingStatus;
use Mobly\Boletoflex\Sdk\Transactions\VerifyStatus;

/**
 * Client class
 *
 * @package Mobly\Boletoflex\Sdk
 *
 * @author Diego Galdino Jaldim <diego.jaldim@mobly.com.br>
 * @author Mangierre Martins <mangierre.martins@mobly.com.br>
 *
 */

class Client extends AbstractClient
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

        $response = $this->client->request(
            self::POST,
            self::ENDPOINT_PRE_APPROVAL,
            [
                self::JSON => [
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

    /**
     * @param VerifyFundingStatus $verifyFundingStatus
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function verifyFundingStatus(VerifyFundingStatus $verifyFundingStatus)
    {
        $url = sprintf(
            self::ENDPOINT_STATUS,
            $verifyFundingStatus->getIdTransaction()
        );

        $response = $this->client->request(
            self::GET,
            $url
        );

        return $response;
    }

}
