<?php

namespace PeterColes\Tests\Integration;

class ReportTest extends BaseTest
{
    public function testXero()
    {
        $response = $this->xero->report('BalanceSheet')->request();

        $this->assertTrue(is_array($response->Reports));
        $this->assertTrue(is_array($response->Reports[ 0 ]->Rows));
        $this->assertEquals('BalanceSheet', $response->Reports[0]->ReportID);
        $this->assertEquals('Balance Sheet', $response->Reports[0]->ReportName);
    }
}
