<?php

namespace PeterColes\Xero\Http;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const ENDPOINT = 'https://api.xero.com/api.xro/2.0/';

    protected $guzzleClient;
    protected $method;
    protected $endpoint;
    protected $data;
    protected $headers = [ ];

    public function __construct($config)
    {
        $stack = HandlerStack::create();

        $stack->push(new Oauth1([ 
            'consumer_key' => $config[ 'consumer_key' ],
            'token' => $config[ 'consumer_key' ],
            'token_secret' => $config[ 'consumer_secret' ],
            'private_key_file' => $config[ 'private_key_file' ],
            'private_key_passphrase' => $config[ 'private_key_passphrase' ],
            'signature_method' => Oauth1::SIGNATURE_METHOD_RSA,
        ]));

        $this->guzzleClient = new HttpClient([ 'handler' => $stack ]);
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setEndpoint($resource)
    {
        $this->endpoint = self::ENDPOINT.$resource;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function send()
    {
        $options = [
            'auth' => 'oauth',
            'verify' => __DIR__.'/../../cert/ca-bundle.crt',
            'headers' => $this->headers
        ];

        if ($this->data) {
            $options[ 'form_params' ] = $this->data;
        }

        try {
            $response = $this->guzzleClient->request($this->method, $this->endpoint, $options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        return $this->getBody($response);
    }

    /**
     * Get http response body, cast to a string to extract the data from the stream.
     *
     * @param ResponseInterface $response
     * @return string
     */
    protected function getBody(ResponseInterface $response)
    {
        return (string) $response->getBody();
    }
}
