<?php

namespace App\Models;
use App\Models\ExomereModel;


class ExOrder extends ExomereModel
{

    protected $table = 'ex_orders';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
}
