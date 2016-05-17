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
     * Theendpoint to which requests will be directed.
     */
    protected $endpoint;

    /**
     * The parameters that will be passed to the API method being invoked.
     */
    protected $params = null;

    /**
     * Ensure that we have an HTTP client with which to work
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->httpClient = new HttpClient($config);
    }

    public function instance($params)
    {
        $this->setEndpoint($params[ 0 ]);

        if (isset($params[ 1 ])) {
            $this->setParams($params[ 1 ]);
        }

        return $this;
    }

    public function request()
    {
        $response = $this->httpClient
            ->setMethod(static::METHOD)
            ->setEndpoint($this->endpoint)
            ->send()
        ;

        return $response->{ucfirst($this->resource)};
    }

    protected function setEndpoint($resource)
    {
        $this->resource = $resource;
        $this->endpoint = $resource;
    }

    protected function setParams($params)
    {
        $this->params = $params;
    }
}
