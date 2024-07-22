<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExItem extends ExomereModel
{

    protected $table = 'ex_items';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [
        "code",
        "name",
        "category",
        "kind",
        "price",
        "tax",
        "pv",
        "pv2",
        "mem_price",
        "mem_pv",
        "planer_price",
        "planer_pv",
        "store_price",
        "store_pv",
        "exclusive_price",
        "exclusive_pv",
        "is_active",
        "is_view",
        "remark",
        "thum_img",
        "img",
        "content",
    ];
}
