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

    public function __construct()
    {
        $this->client = new Client();
    }

}