<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CommonConstants;
use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use App\Models\ExDistribute;
use App\Models\ExItem;
use App\Models\ExMember;
use Illuminate\Http\Request;

class ErpBasicController extends Exomere
{
    
    const ITEM_CATEGORY = [
        'skin' => '스킨케어',
        'health' => '헬스케어',
        'etc' => '기타',
    ];

    const ITEM_KIND = [
        'N' => '없음',
        'best' => 'BEST ITEMS',
    ];

    public function memberRegister(Request $request){

        if (isset($request->seq)) {
            $member = ExMember::find($request->seq);
        }

        $data = [
            "member_seq" => $request->seq ?? null,
            "member" => $member ?? [],
        ];

        return view('pages.erp.basic.manager.register')->with($data);
    }

    public function memberSave(Request $request)
    {
        $member_seq = $request->member_seq ?? null;

        $input_data = [
            "member_id" => $request->member_id,
            "name" => $request->name,
            "member_type" => "admin",
            "member_level" => 20,
            "is_delete" => $request->is_delete ?? 'N',
            "remark" => $request->remark,
        ];

        if(isset($request->member_pw)){
            $input_data["member_pw"] = $this->encryptPassword($request->member_pw);
        }

        ExMember::UpdateOrCreate(
            [
                'id' => $member_seq,
            ],
            $input_data
        );
        
        return redirect()->route('basic-layouts-member-list');
    }

    public function managerList(Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $ex_members = ExMember::where('member_level','>',10)->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

        $data = [
            "search_text" => $search_text ?? '',
            "ex_members" =>  $ex_members ?? [],
            "row_num" => $this->getPageRowNumber($ex_members->count(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.basic.manager.list')->with($data);
    }

    public function centerList(Request $request)
    {

        $centers = new ExCenter;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $centers->where('name', 'LIKE', "%{$request->get('search_text')}%");
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
            $director_info = $center->director_id . " | " . $center->director_name;
            $recommended_info = $center->recommended_id . " | " . $center->recommended_name;
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
            "director_id" => explode(" | ", $request->director_info)[0],
            "director_name" => explode(" | ", $request->director)[1],
            "recommended_seq" => $request->recommended_seq,
            "recommended_id" => explode(" | ", $request->recommended_info)[0],
            "recommended_name" => explode(" | ", $request->recommended_info)[1],
            "phone" => $request->phone,
            "fax" => $request->fax,
            "zipcode" => $request->zipcode,
            "address" => $request->address,
            "address_detail" => $request->address_detail,
            "remark" => $request->remark,
            "is_active" => $request->is_active,
        ];

        if ($request->hasFile('thum_img')) {
            $fileName = time() . '_' . $request->file('thum_img')->getClientOriginalName();
            $input_data['thum_img'] = $request->file('thum_img')->storeAs('public/data', $fileName);
            $input_data['thum_img'] = $fileName;
        }
        if ($request->hasFile('img')) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
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

    public function itemList(Request $request)
    {

        // $items = ExItem::where('is_active','Y');
        $items = new ExItem;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $items->where('name', 'LIKE', "%{$request->get('search_text')}%");
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
            "name" => $request->name ?? null,
            "description" => $request->description ?? null,
            "code" => $request->code ?? null,
            "category" => $request->category ?? null,
            "kind" => $request->kind ?? null,
            "sort" => $request->sort ?? 9999,
            "price" => $request->price ?? 0,
            "tax" => $request->tax ?? 0,
            "pv" => $request->pv ?? 0,
            "pv2" => $request->pv2 ?? 0,
            "mem_price" => $request->mem_price ?? 0,
            "mem_pv" => $request->mem_pv ?? 0,
            "planer_price" => $request->planer_price ?? 0,
            "planer_pv" => $request->planer_pv ?? 0,
            "store_price" => $request->store_price ?? 0,
            "store_pv" => $request->store_pv ?? 0,
            "exclusive_price" => $request->exclusive_price ?? 0,
            "exclusive_pv" => $request->exclusive_pv ?? 0,
            "stock" => $request->stock ?? 0,
            "is_active" => $request->is_active ?? 'N',
            "is_view" => $request->is_view ?? 'N',
            "remark" => $request->remark ?? null,
            "content" => $request->content ?? null,
            "capacity" => $request->capacity ?? null,
            "functionality" => $request->functionality ?? 0,
            "efficacy" => $request->efficacy ?? null,
            "usage_capacity" => $request->usage_capacity ?? null,
            "precautions" => $request->precautions ?? null,
            "quality_standard" => $request->quality_standard ?? null,
            "manufacturer" => $request->manufacturer ?? null,
            "responsible_seller" => $request->responsible_seller ?? null,
            "inquiries" => $request->inquiries ?? null,
            "expiration_date" => $request->expiration_date ?? null,
            "country_manufacture" => $request->country_manufacture ?? null,
        ];

        if ($request->hasFile('thum_img')) {
            $fileName = time() . '_' . $request->file('thum_img')->getClientOriginalName();
            $input_data['thum_img'] = $request->file('thum_img')->storeAs('public/data', $fileName);
            $input_data['thum_img'] = $fileName;
        }

        if ($request->hasFile('thum_img2')) {
            $fileName = time() . '_' . $request->file('thum_img2')->getClientOriginalName();
            $input_data['thum_img2'] = $request->file('thum_img2')->storeAs('public/data', $fileName);
            $input_data['thum_img2'] = $fileName;
        }

        if ($request->hasFile('img')) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
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
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $distributes = ExDistribute::orderBy('id', 'desc')->paginate($limitPage);

        $data = [
            "search_text" => $search_text ?? '',
            "distributes" =>  $distributes ?? [],
            "row_num" => $this->getPageRowNumber($distributes->count(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.basic.distribute.list')->with($data);
    }

    public function distributeRegister(Request $request)
    {

        if (isset($request->seq)) {
            $distribute = ExDistribute::find($request->seq);
            $director_info = $distribute->director_id . " | " . $distribute->director_name;
        }

        $data = [
            "bank_list" => CommonConstants::BANK_LIST,
            "distribute_seq" => $request->seq ?? null,
            "director_info" => $director_info ?? '',
            "distribute" => $distribute ?? [],
        ];

        return view('pages.erp.basic.distribute.register')->with($data);
    }

    public function distributeSave(Request $request)
    {
        $distribute_seq = $request->distribute_seq ?? null;

        $input_data = [
            "director_seq" => $request->director_seq,
            "director_id" => explode(" | ", $request->director_info)[0],
            "director_name" => explode(" | ", $request->director_info)[1],
            "name" => $request->name,
            "code" => $request->code,
            "pg_code" => $request->pg_code,
            "business_name" => $request->business_name,
            "business_num" => $request->business_num,
            "director_phone" => $request->director_phone,
            "phone" => $request->phone,
            "fax" => $request->fax,
            "address" => $request->address,
            "address_detail" => $request->address_detail,
            "zipcode" => $request->zipcode,
            "bank" => $request->bank,
            "account_num" => $request->account_num,
            "account_holder" => $request->account_holder,
            "remark" => $request->remark,
            "is_active" => $request->is_active ?? '',
        ];

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
        return redirect()->route('basic-layouts-distribute-list');
    }

    public function memberDel(Request $request)
    {
        ExMember::find($request->seq)->update(['is_delete' => 'Y']);
        return redirect()->route('basic-layouts-member-list');
    }

    
}
