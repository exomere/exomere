<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExInquiresComment extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    /**
     * Get the inquiry that owns the comment.
     */
    public function inquiry()
    {
        return $this->belongsTo(ExInquire::class, 'inquiry_seq');
    }

    /**
     * Get the author of the comment.
     */
    public function author()
    {
        return $this->belongsTo(ExMember::class, 'author_seq');
    }
}
