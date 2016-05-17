<?php

namespace PeterColes\Xero;

class Xero
{
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __call($method, $params)
    {
        $class = 'PeterColes\\Xero\\Api\\'.ucfirst($method);
        if (class_exists($class)) {
            return call_user_func([new $class($this->config), 'instance'], $params);
        }
    }
}
