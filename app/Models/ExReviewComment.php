<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExReviewComment extends Model
{
    use HasFactory;

    protected $table = 'ex_reviews_comments';

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    // 리뷰와의 관계 설정 (N:1 관계)
    public function review(): BelongsTo
    {
        return $this->belongsTo(ExReview::class, 'review_seq');
    }
}