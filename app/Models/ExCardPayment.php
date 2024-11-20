<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExCardPayment extends ExomereModel
{

    protected $table = 'ex_card_payment';
    
    public $timestamps = null;

    protected $guarded = [];

    protected $fillable = [];
}
