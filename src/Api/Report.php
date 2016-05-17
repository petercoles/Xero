<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Api\ApiInterface;

class Report extends BaseApi implements ApiInterface
{
    const METHOD = 'get';

    /**
     * Reports have a different endpoint structure to other API calls
     * which we reflect in the setter below
     *
     * @param array $resource
     */
    protected function setEndpoint($resource)
    {
        $this->resource = 'reports';
        $this->endpoint = "reports/$resource";
    }
}
