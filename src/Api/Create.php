<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Api\ApiInterface;

class Create extends BaseApi implements ApiInterface
{
    const METHOD = 'put';

    protected $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'Accept' => 'application/json',
        'Encoding' => 'UTF-8'
    ];
}
