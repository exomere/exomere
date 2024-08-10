<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExItem extends ExomereModel
{

    protected $table = 'ex_items';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
}
