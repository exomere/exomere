<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExStatements extends ExomereModel
{

    protected $table = 'ex_statements';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
  
}
