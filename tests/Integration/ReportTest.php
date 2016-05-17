<?php

namespace PeterColes\Tests\Integration;

class ReportTest extends BaseTest
{
    public function testXero()
    {
        $response = $this->xero->report('BalanceSheet')->request();

        $this->assertTrue(is_array($response));
        $this->assertTrue(is_array($response[0]->Rows));
        $this->assertEquals('BalanceSheet', $response[0]->ReportID);
        $this->assertEquals('Balance Sheet', $response[0]->ReportName);
    }
}
