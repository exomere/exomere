<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExReviewComment extends Model
{
    use HasFactory;

    protected $table = 'ex_reviews_comments';

    // 리뷰와의 관계 설정 (N:1 관계)
    public function review()
    {
        return $this->belongsTo(ExReview::class, 'review_seq');
    }
}