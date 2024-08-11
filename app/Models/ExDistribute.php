<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExDistribute extends ExomereModel
{

    protected $table = 'ex_distribute';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];

    public function getDirectorInfo()
    {
        return $this->hasOne(ExMember::class, "seq", "director_seq");
    }

    public function getRecommendInfo()
    {
        return $this->hasOne(ExMember::class, "seq", "recommended_seq");
    }
}
