<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExReview extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];


    /*상품*/
    public function item()
    {
        return $this->hasOne(ExItem::class, "id", "product_seq");
    }

    /*코멘트*/
    public function comments()
    {
        return $this->hasMany(ExReviewComment::class, "review_seq");
    }

    /*추천*/
    public function likes()
    {
        return $this->hasMany(ExReviewLike::class, 'review_seq');
    }

    /*이전글*/
    public function previous()
    {
        return $this->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    /*다음글*/
    public function next()
    {
        return $this->where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->first();
    }

    /*좋아요여부*/
    public function likedByUser($author_seq)
    {
        return $this->likes()->where('author_seq', $author_seq)->exists();
    }
}
