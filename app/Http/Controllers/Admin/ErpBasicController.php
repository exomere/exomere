<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CommonConstants;
use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use App\Models\ExDistribute;
use App\Models\ExItem;
use Illuminate\Http\Request;

class ErpBasicController extends Exomere
{
    public function managerList (Request $request)
    {
        return view('pages.erp.basic.manager.list')->with([]);
    }

    public function centerList(Request $request)
    {

        $centers = new ExCenter;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $centers->where('name','LIKE',"%{$request->get('search_text')}%");
        }

        $centers->limit($limitPage)->orderBy('id', 'desc');

        $data = [
            "search_text" => $search_text ?? '',
            "centers" =>  $centers ?? [],
            "row_num" => $this->getPageRowNumber($centers->count(), $page, $limitPage) ?? null,
            "paga_nation" => $this->pagaNation($centers, $limitPage),
        ];

        return view('pages.erp.basic.center.list')->with($data);
    }


    public function centerRegister(Request $request)
    {

        if (isset($request->seq)) {
            $center = ExCenter::find($request->seq);
            $director_info = $center->director_id." | ". $center->director_name;
            $recommended_info = $center->recommended_id." | ". $center->recommended_name;
        }

        $data = [
            "center_seq" => $request->seq ?? null,
            "center" => $center ?? [],
            "director_info" => $director_info ?? '',
            "recommended_info" => $recommended_info ?? '',
        ];

        return view('pages.erp.basic.center.register')->with($data);
    }

    public function centerSave(Request $request)
    {

        $center_seq = $request->center_seq ?? null;

        // dd($request->input());
        $input_data = [
            "name" => $request->name,
            "director_seq" => $request->director_seq,
            "director_id" => explode(" | ",$request->director_info)[0],
            "director_name" => explode(" | ",$request->director_info)[1],
            "recommended_seq" => $request->recommended_seq,
            "recommended_id" => explode(" | ",$request->recommended_info)[0],
            "recommended_name" => explode(" | ",$request->recommended_info)[1],
            "phone" => $request->phone,
            "fax" => $request->fax,
            "zipcode" => $request->zipcode,
            "address" => $request->address,
            "address_detail" => $request->address_detail,
            "remark" => $request->remark,
            "is_active" => $request->is_active,
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

        ExCenter::UpdateOrCreate(
            [
                'id' => $center_seq,
            ],
            $input_data
        );

        return redirect()->route('basic-layouts-center-list');
    }

    public function centerDel(Request $request)
    {
        ExCenter::find($request->seq)->delete();
        return redirect()->route('basic-layouts-center-list');
    }




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

        return view('pages.erp.basic.item.list')->with($data);
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
        return view('pages.erp.basic.item.register')->with($data);
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



    public function distributeList(Request $request)
    {
        // $distributes = ExDistribute::where('is_active','Y');
        $distributes = new ExDistribute;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $distributes->where('name','LIKE',"%{$request->get('search_text')}%");
        }

        $distributes->limit($limitPage)->orderBy('id', 'desc');

        $data = [
            "search_text" => $search_text ?? '',
            "distributes" =>  $distributes ?? [],
            "row_num" => $this->getPageRowNumber($distributes->count(), $page, $limitPage) ?? null,
            "paga_nation" => $this->pagaNation($distributes, $limitPage),
        ];

        return view('pages.erp.basic.distribute.list')->with($data);
    }

    public function distributeRegister(Request $request)
    {

        if (isset($request->seq)) {
            $distribute = ExDistribute::find($request->seq);
        }

        $data = [
            "bank_list" => CommonConstants::BANK_LIST,
            "distribute_seq" => $request->seq ?? null,
            "distribute" => $distribute ?? [],
        ];
        return view('pages.erp.basic.distribute.register')->with($data);
    }

    public function distributeSave(Request $request)
    {

        $distribute_seq = $request->distribute_seq ?? null;

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

        ExDistribute::UpdateOrCreate(
            [
                'id' => $distribute_seq,
            ],
            $input_data
        );

        return redirect()->route('basic-layouts-distribute-list');
    }

    public function distributeDel(Request $request)
    {
        ExDistribute::find($request->seq)->delete();
        return redirect()->route('basic-layouts-item-list');
    }
}
