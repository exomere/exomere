<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ExMember extends Authenticatable
{
    use HasFactory;

    protected $table = 'ex_members';
    
    public $timestamps = true;
    protected $guarded = [];
    protected $fillable = [];

    /**
     * Retrieve a member by their ID.
     *
     * @param string $memberId
     * @return ExMember|null
     */
    public static function findByMemberId(string $memberId): ?ExMember
    {
        return self::where('member_id', $memberId)->first();
    }
}
