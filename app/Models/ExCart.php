<?php

namespace App\Models;

use App\Models\ExMember;
use App\Models\ExomereModel;
use App\Models\ExItem;


class ExCart extends ExomereModel
{

    protected $table = 'ex_cart';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];

    public function getItemInfo()
    {
      return $this->hasOne(ExItem::class,"id","pd_seq")->first();
    }
  

}
