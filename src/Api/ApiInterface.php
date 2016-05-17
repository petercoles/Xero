<?php

namespace PeterColes\Xero\Api;

interface ApiInterface
{
    public function instance($params);

    public function request();
}
