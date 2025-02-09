<?php

namespace App\Models;

use App\Models\ExomereModel;
use Illuminate\Contracts\Database\Eloquent\Builder;


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


    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $this->where('is_active', 'Y');
    }

}
