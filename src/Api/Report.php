<?php

namespace PeterColes\Xero\Api;

class Report extends BaseApi
{
    const METHOD = 'get';

    protected function setEndpoint($resource)
    {
        $this->resource = 'reports';
        $this->endpoint = "reports/$resource";
    }
}
