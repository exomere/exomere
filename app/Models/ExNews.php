<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExNews extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

}
