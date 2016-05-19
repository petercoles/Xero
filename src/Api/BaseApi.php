<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Http\Client as HttpClient;

abstract class BaseApi
{
    /**
     * The HTTP client that will be used to send requests
     */
    protected $httpClient;

    /**
     * The API resource being requested or acted upon.
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
     * String containing query parameters to be appended to the request.
     */
    protected $where = '';

    /**
     * Ensure that we have an HTTP client with which to work
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->httpClient = new HttpClient($config);
    }

    /**
     * store endpoint and parameters, and return an instance suitable for chaining
     *
     * @param array $params
     * @return ApiInstance
     */
    public function instance($params)
    {
        $this->setEndpoint($params[ 0 ]);

        if (isset($params[ 1 ])) {
            $this->setParams($params[ 1 ]);
        }

        return $this;
    }

    /**
     * Dispatch request and return the required resource
     *
     * @return array
     */
    public function request()
    {
        $response = $this->httpClient
            ->setMethod(static::METHOD)
            ->setEndpoint($this->endpoint.$this->where)
            ->send()
        ;

        return $response->{ucfirst($this->resource)};
    }

    public function where($queryParams)
    {
        $this->where = '?where='.rawurlencode($queryParams);
        return $this;
    }

    /**
     * Apply resource name. Normally this will double as the final uri segment
     * of the endpoint, but not always (Yes, I'm talking about you "reports")
     *
     * @param array $resource
     */
    protected function setEndpoint($resource)
    {
        $this->resource = $resource;
        $this->endpoint = $resource;
    }

    /**
     * Simple setter for parameters - likely to be overridden frequently
     *
     * @param array $params
     */
    protected function setParams($params)
    {
        $this->params = $params;
    }
}
