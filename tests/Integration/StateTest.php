<?php

namespace PeterColes\Tests\Integration;

class StateTest extends BaseTest
{
    public function testBalanceSheet()
    {
        $response = $this->xero->state('BalanceSheet')->request();

        $this->assertTrue(is_array($response));
        $this->assertObjectHasAttribute('Id', $response[0]);
        $this->assertObjectHasAttribute('Type', $response[0]);
        $this->assertObjectHasAttribute('Name', $response[0]);
        $this->assertObjectHasAttribute('Value', $response[0]);
    }

    public function testProfitAndLoss()
    {
        $response = $this->xero->state('ProfitAndLoss')->request();

        $this->assertTrue(is_array($response));
    }
}
