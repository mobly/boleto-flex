<?php

namespace Mobly\Boletoflex\Sdk;

interface Endpoint
{

    /**
     * @const string
     */
    const ENDPOINT_STATUS = '/transactions/%s/status';

    /**
     * @const string
     */
    const ENDPOINT_PRE_APPROVAL = '/transactions/qualify';

    /**
     * @const string
     */
    const ENDPOINT_TRANSACTION = '/transactions';
}
