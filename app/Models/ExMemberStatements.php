<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExMemberStatements extends ExomereModel
{

    protected $table = 'ex_member_statements';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];
  
}
