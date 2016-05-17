<?php

namespace PeterColes\Tests\Integration;

class FetchTest extends BaseTest
{
    public function testXero()
    {
        $response = $this->xero->fetch('accounts')->request();

        $this->assertTrue(is_array($response));
        $this->assertObjectHasAttribute('AccountID', $response[0]);
        $this->assertObjectHasAttribute('EnablePaymentsToAccount', $response[0]);
    }
}
