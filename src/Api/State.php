<?php

namespace PeterColes\Xero\Api;

use PeterColes\Xero\Api\ApiInterface;
use PeterColes\Xero\Api\Report;

class State implements ApiInterface
{
    /**
     * Parameters are received by instance method and stored
     * to be passed to the class(es) being aliased
     */
    protected $params;

    /**
     * New up an instance of the report class
     * from which we'll be drawing our raw data
     *
     * @param  array $config
     */
    public function __construct($config)
    {
        $this->report = new Report($config);
    }

    /**
     * Store the params received and return an instance
     * of this class for chaining
     *
     * @param  array $params
     * @return State
     */
    public function instance($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Request and massage requested data from Report
     *
     * @return array
     */
    public function request()
    {
        $data = $this->report->instance($this->params)->request();

        $report = lcfirst($this->params[ 0 ]);

        return $this->filter($report, $data);
    }

    /**
     * Massage balance sheet data
     *
     * @param  array $report   data received from Report
     * @return array
     */
    protected function filter($report, $data)
    {
        $outerRows = $data[0]->Rows;

        $balances = [];
        foreach ($outerRows as $outerRow) {
            if ($outerRow->RowType == 'Section' && sizeof($outerRow->Rows) > 0) {
                foreach ($outerRow->Rows as $innerRow) {
                    if ($innerRow->RowType == 'Row' && isset($innerRow->Cells[0]->Attributes)) {
                        $balances[] = (object) $this->$report($innerRow->Cells);
                    }
                }
            }
        }

        return $balances;
    }

    /**
     * Massage balance sheet data
     *
     * @param  array $report   data received from Report
     * @return array
     */
    protected function balanceSheet($data)
    {
        return $this->current($data);
    }

    /**
     * Massage profit and loss data
     *
     * @param  array $report   data received from Report
     * @return array
     */
    protected function profitAndLoss($data)
    {
        return $this->current($data);
    }

    /**
     * A generic filter to the current state of the data. This has different meanings.
     * In the balance sheet it means the current state, but for the P&L account, it
     * means the non-zero balances for the current month only (YTD to be added soon).
     *
     * @param  array $report   data received from Report
     * @return array
     */
    protected function current($data)
    {
        return [
            'Id' => $data[0]->Attributes[0]->Value,
            'Type' => $data[0]->Attributes[0]->Id,
            'Name' => $data[0]->Value,
            'Value' => $data[1]->Value,
        ];
    }
}
