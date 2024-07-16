<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Member extends Authenticatable
{

  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'member';
  protected $primaryKey = 'seq';

  const UPDATED_AT = null;

  protected $fillable = [
    "code",
    "type",
    "id",
    "pw",
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
