<?php

namespace App\Models;

use App\Models\ExMember;
use App\Models\ExomereModel;


class ExPointLog extends ExomereModel
{

    protected $table = 'ex_point_log';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
}
