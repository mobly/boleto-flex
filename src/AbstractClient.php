<?php

namespace Mobly\Boletoflex\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

abstract class AbstractClient implements Endpoint
{
    /**
     * @const string
     */
    const JSON = RequestOptions::JSON;

    /**
     * @const string
     */
    const POST = 'POST';

    /**
     * @const string
     */
    const GET = 'GET';

    /**
     * @var Client $client
     */
    protected $client;

    /**
     * @var string
     */
    protected $host;

    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }
}
