<?php

namespace App\Models;

use App\Models\ExMember;
use App\Models\ExomereModel;


class ExOrder extends ExomereModel
{

    protected $table = 'ex_orders';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];

    public function findByMemberRecommend()
    {
      return $this->hasMany(ExMember::class, "id","member_seq");
    }
  
}
