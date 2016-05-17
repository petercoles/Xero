<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Http\Client as HttpClient;

abstract class BaseApi
{
    /**
     * HTTP client
     */
    protected $httpClient;

    /**
     * The API resource being acted up.
     */
    protected $resource;

    /**
     * The parameters that will be passed to the API method being invoked.
     */
    protected $params = null;

    /**
     * Ensure that we have an HTTP client with which to work
     *
     * @param HttpClient $httpClient
     */
    public function __construct($config)
    {
        $this->httpClient = new HttpClient($config);
    }

    public function instance($params)
    {
        $this->setResource($params[ 0 ]);

        if (isset($params[ 1 ])) {
            $this->setParams($params[ 1 ]);
        }

        return $this;
    }

    public function request()
    {
        return $this->httpClient
            ->setMethod($this->method)
            ->setEndpoint($this->resource)
            ->send()
        ;
    }

    protected function setResource($resource)
    {
        $this->resource = $resource;
    }

    protected function setParams($params)
    {
        $this->params = $params;
    }
}
