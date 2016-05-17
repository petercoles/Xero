<?php

namespace PeterColes\Tests\Integration;

class FetchTest extends BaseTest
{
    public function testXero()
    {
        $response = $this->xero->fetch('accounts')->request();

        $this->assertTrue(is_array($response->Accounts));
        $this->assertObjectHasAttribute('AccountID', $response->Accounts[0]);
        $this->assertObjectHasAttribute('EnablePaymentsToAccount', $response->Accounts[0]);
    }
}
