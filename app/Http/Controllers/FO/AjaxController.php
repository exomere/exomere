<?php

namespace App\Http\Controllers\FO;

use Illuminate\Http\Request;

class AjaxController extends BaseController
{
    public function getRecommendSearchKeywords(Request $request): false|string
    {
        $lang = app()->getLocale();

        //TODO ExItem?
        $recommendSearchKeywords = [
            [
                'id' => 1,
                'name' => '리프팅샷 수딩젤 100g',
            ],
            [
                'id' => 1,
                'name' => '퍼펙트 스칼프 토너',
            ],
            [
                'id' => 1,
                'name' => '임플라힐 P.O 크림',
            ],
            [
                'id' => 1,
                'name' => '퍼펙트 스칼프 임플란트 세럼',
            ],
            [
                'id' => 1,
                'name' => '에델바이스스노우크림',
            ],
        ];

        return json_encode($recommendSearchKeywords, JSON_UNESCAPED_UNICODE);
    }
}