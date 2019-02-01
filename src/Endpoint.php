<?php

namespace Mobly\Boletoflex\Sdk;


interface Endpoint
{

    /**
     * @const string
     */
    const ENDPOINT_STATUS = 'https://api-checkout.vality.com.br/transactions/%s/status';

    /**
     * @const string
     */
    const ENDPOINT_PRE_APPROVAL = 'https://api-checkout.vality.com.br/transactions/qualify';

    /**
     * @const string
     */
    const ENDPOINT_TRANSACTION = 'https://api-checkout.vality.com.br/transactions';

}