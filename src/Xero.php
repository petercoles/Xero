<?php

namespace PeterColes\Xero;

class Xero
{
    /**
     * The credentials needed to authenticate an API call
     */
    protected $config;

    /**
     * Constructor
     * 
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Magic method to direct requests to the appropriate API class
     *
     * @param string $method
     * @param array  $params
     */
    public function __call($method, $params)
    {
        $class = 'PeterColes\\Xero\\Api\\'.ucfirst($method);
        if (class_exists($class)) {
            return call_user_func([ new $class($this->config), 'instance' ], $params);
        }
    }
}
