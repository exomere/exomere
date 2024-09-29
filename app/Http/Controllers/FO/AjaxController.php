<?php

namespace App\Http\Controllers\FO;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AjaxController extends BaseController
{
    public function getRecommendSearchKeywords(Request $request): false|string
    {

        //todo ExItem
        $lang = app()->getLocale();

        /** @var Collection $bestProduct */
        $bestProduct = app(ProductController::class)->bestProducts();
        $recommendSearchKeywords = $bestProduct
            ->select(['id', 'product_name'])
            ->toArray();

        return json_encode($recommendSearchKeywords, JSON_UNESCAPED_UNICODE);
    }
}