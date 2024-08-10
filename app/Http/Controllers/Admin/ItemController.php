<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use Illuminate\Support\Facades\Storage;
class ItemController extends Exomere
{

    CONST ITEM_CATEGORY = [
      'skin' => '스킨케어',
      'health' => '헬스케어',
      'etc' => '기타',
    ];

    CONST ITEM_KIND = [
      'N' => '없음',
      'signature' => '대표상품',
    ];

    public function itemList(Request $request)
    {

        // $items = ExItem::where('is_active','Y');
        $items = new ExItem;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $items->where('name','LIKE',"%{$request->get('search_text')}%");
        }
      
        $items->limit($limitPage)->orderBy('id', 'desc');
        
        $data = [
          "search_text" => $search_text ?? '',
          "items" =>  $items ?? [],
          "item_category" => self::ITEM_CATEGORY,
          "row_num" => $this->getPageRowNumber($items->count(), $page, $limitPage) ?? null,
          "paga_nation" => $this->pagaNation($items, $limitPage),
        ];

        return view('pages.item.list')->with($data);
    }

    public function itemRegister(Request $request)
    {
  
        if (isset($request->seq)) {
            $item = ExItem::find($request->seq);
          }
          
          $data = [
            "item_seq" => $request->seq ?? null,
            "item_category" => self::ITEM_CATEGORY,
            "item_kind" => self::ITEM_KIND,
            "item" => $item ?? [],
          ];
          return view('pages.item.register')->with($data);
    }

    public function itemSave(Request $request)
    {

      $item_seq = $request->item_seq ?? null;

      $input_data = [
        "name" => $request->name ?? null ,
        "description" => $request->description ?? null ,
        "code" => $request->code ?? null,
        "category" => $request->category ?? null ,
        "kind" => $request->kind ?? null ,
        "price" => $request->price ?? 0 ,
        "tax" => $request->tax ?? 0 ,
        "pv" => $request->pv ?? 0 ,
        "pv2" => $request->pv2 ?? 0 ,
        "mem_price" => $request->mem_price ?? 0 ,
        "mem_pv" => $request->mem_pv ?? 0 ,
        "planer_price" => $request->planer_price ?? 0 ,
        "planer_pv" => $request->planer_pv ?? 0 ,
        "store_price" => $request->store_price ?? 0 ,
        "store_pv" => $request->store_pv ?? 0 ,
        "exclusive_price" => $request->exclusive_price ?? 0 ,
        "exclusive_pv" => $request->exclusive_pv ?? 0 ,
        "stock" => $request->stock ?? 0 ,
        "is_active" => $request->is_active ?? 'N' ,
        "is_view" => $request->is_view ?? 'N' ,
        "remark" => $request->remark ?? null ,
        "content" => $request->content ?? null ,
        "capacity" => $request->capacity ?? null ,
        "functionality" => $request->functionality ?? 0 ,
        "efficacy" => $request->efficacy ?? null ,
        "usage_capacity" => $request->usage_capacity ?? null ,
        "precautions" => $request->precautions ?? null ,
        "quality_standard" => $request->quality_standard ?? null ,
        "manufacturer" => $request->manufacturer ?? null ,
        "responsible_seller" => $request->responsible_seller ?? null ,
        "inquiries" => $request->inquiries ?? null ,
        "expiration_date" => $request->expiration_date ?? null ,
        "country_manufacture" => $request->country_manufacture ?? null ,
      ];

      if($request->hasFile('thum_img')){
        $fileName = time().'_'.$request->file('thum_img')->getClientOriginalName();
        $input_data['thum_img'] = $request->file('thum_img')->storeAs('public/data', $fileName);
        $input_data['thum_img'] = $fileName;
        
      }
      if($request->hasFile('img')){
        $fileName = time().'_'.$request->file('img')->getClientOriginalName();
        $request->file('img')->storeAs('public/data', $fileName);
        $input_data['img'] = $fileName;
      }

      ExItem::UpdateOrCreate(
        [
          'id' => $item_seq,
        ],
          $input_data
      );

      return redirect()->route('basic-layouts-item-list');
    }

    public function itemDel(Request $request)
    {
      ExItem::find($request->seq)->delete();
      return redirect()->route('basic-layouts-item-list');
    }

    

    
}
