<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Api\ApiInterface;

class Download extends BaseApi implements ApiInterface
{
    const METHOD = 'get';

    protected $headers = [
        'Accept' => 'application/pdf',
    ];

    /**
     * By default we request a json response,
     * but not here, so we override the base method
     *
     * @param string $response
     */
    protected function handleResponse($response)
    {
        return $response;
    }
}
