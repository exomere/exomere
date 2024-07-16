<?php

namespace App\Models;
use App\Models\ExomereModel;


class Item extends ExomereModel
{

  protected $table = 'item';
  protected $primaryKey = 'seq';

  const UPDATED_AT = null;

  protected $fillable = [
    "code",
    "name",
    "category",
    "kind",
    "price",
    "tax",
    "pv",
    "pv2",
    "mem_price",
    "mem_pv",
    "planer_price",
    "planer_pv",
    "store_price",
    "store_pv",
    "exclusive_price",
    "exclusive_pv",
    "is_active",
    "is_view",
    "remark",
    "thum_img",
    "img",
    "content",
    "created_at",
  ];
}
