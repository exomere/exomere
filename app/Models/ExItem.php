<?php

namespace App\Models;

use App\Models\ExomereModel;


class ExItem extends ExomereModel
{

    protected $table = 'ex_items';
    
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = [];


    function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ExReview', 'product_seq')
            ->orderByDesc('id')
            ->orderByDesc('rating');
    }


}
