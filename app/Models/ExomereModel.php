<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ExomereModel extends Model
{
  protected $connection = "";
  protected $table = "";

  public function checkTablePresence($group,$table){
    return Schema::connection($group)->hasTable($this->outPutTableName($group,$table));
  }
}
