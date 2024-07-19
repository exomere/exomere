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
    protected $fillable = [
        "code",
        "type",
        "member_id",
        "member_pw",
        "phone",
        "email",
        "area",
        "exclusive_seq",
        "recommend_seq",
        "zip_code",
        "address",
        "adress_detail",
        "country",
        "paid_point",
        "created_at",
    ];
}
