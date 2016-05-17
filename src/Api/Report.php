<?php

namespace PeterColes\Xero\Api;

class Report extends BaseApi
{
    const METHOD = 'get';

    protected function setResource($resource)
    {
        $this->resource = "reports/$resource";
    }
}
