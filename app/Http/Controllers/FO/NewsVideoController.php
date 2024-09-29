<?php

namespace App\Http\Controllers\FO;

use App\Models\ExNews;
use App\Models\ExVideo;
use Illuminate\Http\Request;

class NewsVideoController extends BaseController
{

    public function news(Request $request)
    {
        $selectedCategory = request()->get('category') ?? null;

        $categories = [
            "view_all",
            'company',
            'rnd',
            'social',
        ];

        $allItems = ExNews::whereNotNull('category')->get();
        foreach ($allItems as &$item) {
            $item->thumbnail = asset($item->thumbnail);
        }

        $categorizeItems = $allItems->groupBy('category');//카테고리화

        $items = collect([
            'view_all' => $allItems
        ])->merge($categorizeItems);

        return view('pages.newsandmedia.news', compact('allItems', 'items', 'categories', 'selectedCategory'));
    }

    public function videos()
    {
        $items = ExVideo::all();

        foreach ($items as &$item) {
            $item->thumbnail = asset($item->thumbnail);
            $item->video = asset($item->video);
        }

        $mainVideo = $items->shift();

        return view('pages.newsandmedia.videos', compact('items', 'mainVideo'));
    }

}