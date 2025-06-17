<?php

namespace App\Models;

use App\Models\ExomereModel;

class ExItemStockLog extends ExomereModel
{
    protected $table = 'ex_item_stock_log';
    protected $primaryKey = 'id';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        "stock_seq",
        "item_seq",
        "etc_seq",
        "stock_date",
        "type",
        "category",
        "after_stock",
        "target_stock",
        "before_stock",
        "remark",
    ];
}
