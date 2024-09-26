<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExCenter extends ExomereModel
{

    protected $table = 'ex_center';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];

        /**
     * @param int $id
     * @return ExCenter|null
     */
    public static function findByCenterSeq(int $id): ?ExCenter
    {
        return self::where('id', $id)->first();
    }

}
