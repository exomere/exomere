<?php

namespace App\Models;

use App\Models\ExMember;
use App\Models\ExomereModel;


class ExCart extends ExomereModel
{

    protected $table = 'ex_cart';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];

}
