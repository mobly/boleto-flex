<?php

namespace Mobly\Boletoflex\Sdk;

use Mobly\Boletoflex\Sdk\Entities\AbstractEntity;
use Mobly\Boletoflex\Sdk\Entities\Cart;
use Mobly\Boletoflex\Sdk\Entities\CartItem;
use Mobly\Boletoflex\Sdk\Entities\EmptyEntity;
use Mobly\Boletoflex\Sdk\Entities\HistoryItem;
use Mobly\Boletoflex\Sdk\Entities\Service;
use Mobly\Boletoflex\Sdk\Transactions\PreApproval;
use Mobly\Boletoflex\Sdk\Transactions\Simulate;
use Mobly\Boletoflex\Sdk\Transactions\Transaction;
use Mobly\Boletoflex\Sdk\Transactions\VerifyFundingStatus;

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
     * @param Transaction $transaction
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function transaction(Transaction $transaction)
    {
        $seller = $transaction->getSeller();
        $buyer = $transaction->getBuyer();
        $shipping = $transaction->getShipping();
        $shippingAddress = $shipping->getAddress();
        $payment = $transaction->getPayment();
        $source = $transaction->getSource();

        $content = [
            'buyer' => [
                'phoneNumber' => $buyer->getPhoneNumber(),
                'name' => $buyer->getName(),
                'cpf' => $buyer->getCpf(),
                'email' => $buyer->getEmail(),
            ],
            'reference' => $transaction->getReference(),
            'seller' => [
                'name' => $seller->getName()
            ],
            'source' => [
                'name' => $source->getName(),
            ],
            'shipping' => [
                'amount' => $shipping->getAmount(),
                'address' => [
                    'zip' => $shippingAddress->getZip(),
                    'number' => $shippingAddress->getNumber(),
                    'country' => $shippingAddress->getCountry(),
                    'city' => $shippingAddress->getCity(),
                    'street' => $shippingAddress->getStreet(),
                    'district' => $shippingAddress->getDistrict(),
                    'state' => $shippingAddress->getState(),
                    'complement' => $shippingAddress->getComplement(),
                ],
            ],
            'currency' => $transaction->getCurrency(),
            'payment' => [
                'amount' => $payment->getAmount(),
                'discount' => $payment->getDiscount(),
                'cart' => $payment->getCart(),
                'other' => $this->buildServicePayment(
                    $payment->getService()
                ),
            ],
            'cart' => $this->buildCartTransaction(
                $transaction->getCart()
            ),
            'history' => $this->buildHistoryTransaction(
                $transaction->getHistory()
            )
        ];

        $response = $this->getClient()->request(
            self::POST,
            $this->getRealPath(self::ENDPOINT_TRANSACTION),
            [
                self::JSON => $content
            ]
        );

        return $response;
    }

    /**
     * @param array $services
     * @return array
     */
    private function buildServicePayment(array $services)
    {
        $content = [];

        foreach ($services as $service) {
            if (!$service instanceof Service) {
                continue;
            }

            $content[] = [
                'description' => $service->getDescription(),
                'amount' => round($service->getAmount(), 2),
            ];
        }

        return $content;
    }

    /**
     * @param Cart $cart
     * @return array
     */
    private function buildCartTransaction(Cart $cart)
    {
        $content = [];
        $items = $cart->getItems();

        /** @var CartItem $item */
        foreach ($items as $item) {
            $content[] = [
                'amount' => $item->getAmount(),
                'quantity' => $item->getQuantity(),
                'description' => $item->getDescription(),
                'weight' => $item->getWeight(),
                'sku' => $item->getSku(),
                'category' => $item->getCategory()
            ];
        }

        return $content;
    }

    /**
     * @param AbstractEntity $history
     * @return array
     */
    private function buildHistoryTransaction(AbstractEntity $history)
    {
        if ($history instanceof EmptyEntity) {
            return [];
        }

        $content = [];
        $items = $history->getItems();

        /** @var HistoryItem $item */
        foreach ($items as $item) {
            $cart = [];

            /** @var CartItem $cartItem */
            foreach ($item->getCart()->getItems() as $cartItem) {
                $cart[] = [
                    'amount' => $cartItem->getAmount(),
                    'quantity' => $cartItem->getQuantity(),
                    'description' => $cartItem->getDescription(),
                    'sku' => $cartItem->getSku(),
                    'category' => $cartItem->getCategory()
                ];
            }

            $content[] = [
                'date' => $item->getDate(),
                'reference' => $item->getReference(),
                'cart' => $cart,
                'payment' => [
                    'amount' => $item->getPayment()->getAmount()
                ],
                'shipping' => [
                    'amount' => $item->getShipping()->getAmount(),
                    'address' => [
                        'zip' => $item->getShipping()->getAddress()->getZip()
                    ]
                ]
            ];
        }

        return $content;
    }

    /**
     * @param PreApproval $preApproval
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function preApproval(PreApproval $preApproval)
    {
        $response = $this->getClient()->request(
            self::POST,
            $this->getRealPath(self::ENDPOINT_PRE_APPROVAL),
            [
                self::JSON => $preApproval->toArray(false)
            ]
        );

        return $response;
    }
    /**
     * @param Simulate $simulate
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function simulate(Simulate $simulate)
    {
        $response = $this->getClient()->request(
            self::POST,
            $this->getRealPath(self::ENDPOINT_SIMULATE),
            [
                self::JSON => $simulate->toArray(false)
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
            $this->getRealPath(
                self::ENDPOINT_STATUS
            ),
            $verifyFundingStatus->getIdTransaction()
        );

        $response = $this->getClient()->request(
            self::GET,
            $url
        );

        return $response;
    }

    /**
     * @param $path
     * @return string
     */
    private function getRealPath($path)
    {
        return $this->getHost() . $path;
    }
}
