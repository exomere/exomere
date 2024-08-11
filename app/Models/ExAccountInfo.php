<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExAccountInfo extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    /**
     * @param int $id
     * @return ExAccountInfo|null
     */
    public static function findByMemberSeq(int $id): ?ExAccountInfo
    {
        return self::where('member_seq', $id)->first();
    }
}
