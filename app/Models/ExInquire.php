<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExInquire extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    /**
     * Get the comments associated with the inquiry.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ExInquiresComment::class, 'inquiry_seq');
    }

    /**
     * Get the author of the inquiry.
     */
    public function author()
    {
        return $this->belongsTo(ExMember::class, 'author_seq');
    }
}
