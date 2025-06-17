<?php

namespace App\Models;
use App\Models\ExomereModel;

class ExItemStock extends ExomereModel
{
  protected $table = 'ex_item_stock';
  protected $primaryKey = 'id';

  const CREATED_AT = null;
  const UPDATED_AT = null;

  protected $fillable = [
    "item_seq",
    "item_name",
    "stock",
  ];
}
