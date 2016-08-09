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
     * This is used to extract the requested data from the response.
     */
    protected $resource;

    /**
     * The endpoint to which requests will be directed.
     * This is used to build the query string for the request.
     */
    protected $endpoint;

    /**
     * The parameters that will be passed to the API method being invoked.
     */
    protected $params = null;

    /**
     * Headers to be added to the request, e.g. to communicate the required
     * format for the response or set limits on the data returned
     */
    protected $headers = [ 'Accept' => 'application/json' ];

    /**
     * String containing query parameters to be appended to the request.
     */
    protected $query = '';

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
            ->setHeaders($this->headers)
            ->setEndpoint($this->endpoint.$this->query)
            ->setData($this->params)
            ->send()
        ;

        return $this->handleResponse($response);
    }

    /**
     * Merge new headers into existing headers array.
     * New entrytakes precedence.
     *
     * @return ApiInstance
     */
    public function header($header)
    {
        $this->headers = array_merge($this->headers, $header);
        return $this;
    }

    /**
     * Prepare to append query parameters to the request.
     *
     * @return ApiInstance
     */
    public function where($queryParams)
    {
        $this->query = '?where='.rawurlencode($queryParams);
        return $this;
    }

    /**
     * Prepare to append query parameters to the request.
     *
     * @return ApiInstance
     */
    public function offset($offset)
    {
        $this->query = '?offset='.$offset;
        return $this;
    }

    /**
     * Prepare to append query parameters to the request.
     *
     * @return ApiInstance
     */
    public function reference($reference)
    {
        $this->endpoint .= '/'.$reference;
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

    /**
     * By default we request a json response, so we need to decode it
     *
     * @param string $response
     */
    protected function handleResponse($response)
    {
        return json_decode($response)->{ucfirst($this->resource)};
    }
}
