<?php

namespace PeterColes\Tests\Integration;

use PeterColes\Xero\Xero;

require 'tests/Integration/.env.php'; // load authentication credentials

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected $xero;

    protected function setUp()
    {
        $config = [
            'consumer_key'    => getenv('XERO_CONSUMER_KEY'),
            'consumer_secret' => getenv('XERO_CONSUMER_SECRET'),
            'private_key_file' => getenv('XERO_PRIVATE_KEY_FILE'),
            'private_key_passphrase' => getenv('XERO_PRIVATE_KEY_PASSPHRASE'),
        ];

        $this->xero = new Xero($config);
    }
}
