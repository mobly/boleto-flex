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
            ],
            'cart' => $this->buildCartTransaction(
                $transaction->getCart()
            ),
            'history' => $this->buildHistoryTransaction(
                $transaction->getHistory()
            )
        ];

        $response = $this->client->request(
            self::POST,
            self::ENDPOINT_TRANSACTION,
            [
                self::JSON => $content
            ]
        );

        return $response;
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
     * @param History $history
     * @return array
     */
    private function buildHistoryTransaction(History $history)
    {
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
