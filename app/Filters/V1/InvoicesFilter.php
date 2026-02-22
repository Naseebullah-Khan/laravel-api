<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter
{
    protected $allowedParams = [
        "customerId" => ["eq"],
        "amount" => ["eq", "gt", "lt", "gte", "lte"],
        "status" => ["eq", "ne"],
        "bailedDate" => ["eq", "gt", "lt", "gte", "lte"],
        "paidDate" => ["eq", "gt", "lt", "gte", "lte"],
    ];
    protected $columnMap = [
        "customerId" => "customer_id",
        "bailedDate" => "bailed_date",
        "paidDate" => "paid_date",
    ];
    protected $operatorMap = [
        "eq" => "=",
        "lt" => "<",
        "lte" => "<=",
        "gt" => ">",
        "gte" => ">=",
        "ne" => "!=",
    ];
}
