<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExCenter extends ExomereModel
{

    protected $table = 'ex_center';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
}
