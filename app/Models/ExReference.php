<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExReference extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [];

    public function getAttachmentsAttribute($value)
    {
        // '|'로 구분된 문자열을 배열로 변환
        return explode('|', $value);
    }

    public function setAttachmentsAttribute($value)
    {
        // 배열을 '|'로 구분된 문자열로 변환하여 저장
        $this->attributes['attachments'] = implode('|', $value);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
        ];
    }
}
