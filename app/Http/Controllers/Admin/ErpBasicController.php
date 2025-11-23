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
        'none' => '-',
    ];

    const ITEM_KIND = [
        'N' => '없음',
        'signature' => 'BEST ITEMS',
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
            "nation" => $request->session()->get('member_nation') ?? 'KR',
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

        $query = ExMember::where('member_level', '>', 10)->where('is_delete','N')->where('nation',$request->session()->get('member_nation'))->where('site_code',$request->session()->get('site_code'));

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('member_id', 'like', '%' . $search_text . '%')
                    ->orWhere('tel', 'like', '%' . $search_text . '%')
                    ->orWhere('phone', 'like', '%' . $search_text . '%');
            });
        }

        $ex_members = $query->where('is_delete','N')->orderBy('id', 'desc')->paginate($limitPage);

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

        $query = ExCenter::where('is_active','Y')->where('nation',$request->session()->get('member_nation'));

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('director_name', 'like', '%' . $search_text . '%')
                    ->orWhere('director_id', 'like', '%' . $search_text . '%');
            });
        }

        $centers = $query->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }
        
        $data = [
            "search_text" => $search_text ?? '',
            "centers" =>  $centers ?? [],
            "row_num" => $this->getPageRowNumber($centers->count(), $page, $limitPage) ?? null,
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
            "director_name" => explode(" | ", $request->director_info)[1],
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
            "nation" => $request->session()->get('member_nation') ?? 'KR',
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
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $query = ExItem::whereNotNull('id');

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('name_en', 'like', '%' . $search_text . '%');
            });
        }

        $items = $query->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

        $data = [
            "search_text" => $request->search_text ?? '',
            "items" =>  $items ?? [],
            "item_category" => self::ITEM_CATEGORY,
            "row_num" => $this->getPageRowNumber($items->total(), $page, $limitPage) ?? null,
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

        if(!$item_seq){
            $base_price = $request->price;
            $pv = ceil($base_price / 1.1);
            $tax = $base_price - $pv;
            $planer_price = $base_price * 0.9;
            $planer_pv = ceil($planer_price / 1.1);
            $store_price = $base_price * 0.7;
            $store_pv = ceil($store_price / 1.1);
            $exclusive_price = $base_price * 0.45;
            $exclusive_pv = ceil($exclusive_price / 1.1);
            $exclusive_price1 = $base_price * 0.5;
            $exclusive_pv1 = ceil($exclusive_price1 / 1.1);

            $base_price_d = $request->price_d;
            $pv_d = ceil($base_price_d / 1.1);
            $tax_d = $base_price_d - $pv_d;
            $planer_price_d = $base_price_d * 0.9;
            $planer_pv_d = ceil($planer_price_d / 1.1);
            $store_price_d = $base_price_d * 0.7;
            $store_pv_d = ceil($store_price_d / 1.1);
            $exclusive_price_d = $base_price_d * 0.45;
            $exclusive_pv_d = ceil($exclusive_price_d / 1.1);
            $exclusive_price1_d = $base_price_d * 0.5;
            $exclusive_pv1_d = ceil($exclusive_price1_d / 1.1);

            $base_price_y = $request->price_y;
            
            $pv_y = ceil($base_price_y / 1.1);
            $tax_y = $base_price_y - $pv_y;
            $planer_price_y = $base_price_y * 0.9;
            $planer_pv_y = ceil($planer_price_y / 1.1);
            $store_price_y = $base_price_y * 0.7;
            $store_pv_y = ceil($store_price_y / 1.1);
            $exclusive_price_y = $base_price_y * 0.45;
            $exclusive_pv_y = ceil($exclusive_price_y / 1.1);
            $exclusive_price1_y = $base_price_y * 0.5;
            $exclusive_pv1_y = ceil($exclusive_price1_y / 1.1);

            $base_price_c = $request->price_c;
            $pv_c = ceil($base_price_c / 1.1);
            $tax_c = $base_price_c - $pv_c;
            $planer_price_c = $base_price_c * 0.9;
            $planer_pv_c = ceil($planer_price_c / 1.1);
            $store_price_c = $base_price_c * 0.7;
            $store_pv_c = ceil($store_price_c / 1.1);
            $exclusive_price_c = $base_price_c * 0.45;
            $exclusive_pv_c = ceil($exclusive_price_c / 1.1);
            $exclusive_price1_c = $base_price_c * 0.5;
            $exclusive_pv1_c = ceil($exclusive_price1_c / 1.1);
        }else{
            $base_price = $request->base_price ;
            $pv = $request->pv ;
            $tax = $request->tax ;
            $planer_price = $request->planer_price ;
            $planer_pv = $request->planer_pv ;
            $store_price = $request->store_price ;
            $store_pv = $request->store_pv ;
            $exclusive_price = $request->exclusive_price ;
            $exclusive_pv = $request->exclusive_pv ;
            $exclusive_price1 = $request->exclusive_price1 ;
            $exclusive_pv1 = $request->exclusive_pv1 ;

            $base_price_d = $request->base_price_d ;
            $pv_d = $request->pv_d ;
            $tax_d = $request->tax_d ;
            $planer_price_d = $request->planer_price_d ;
            $planer_pv_d = $request->planer_pv_d ;
            $store_price_d = $request->store_price_d ;
            $store_pv_d = $request->store_pv_d ;
            $exclusive_price_d = $request->exclusive_price_d ;
            $exclusive_pv_d = $request->exclusive_pv_d ;
            $exclusive_price1_d = $request->exclusive_price1_d ;
            $exclusive_pv1_d = $request->exclusive_pv1_d ;

            $base_price_y = $request->base_price_y ;
            
            $pv_y = $request->pv_y ;
            $tax_y = $request->tax_y ;
            $planer_price_y = $request->planer_price_y ;
            $planer_pv_y = $request->planer_pv_y ;
            $store_price_y = $request->store_price_y ;
            $store_pv_y = $request->store_pv_y ;
            $exclusive_price_y = $request->exclusive_price_y ;
            $exclusive_pv_y = $request->exclusive_pv_y ;
            $exclusive_price1_y = $request->exclusive_price1_y ;
            $exclusive_pv1_y = $request->exclusive_pv1_y ;

            $base_price_c = $request->base_price_c ;
            $pv_c = $request->pv_c ;
            $tax_c = $request->tax_c ;
            $planer_price_c = $request->planer_price_c ;
            $planer_pv_c = $request->planer_pv_c ;
            $store_price_c = $request->store_price_c ;
            $store_pv_c = $request->store_pv_c ;
            $exclusive_price_c = $request->exclusive_price_c ;
            $exclusive_pv_c = $request->exclusive_pv_c ;
            $exclusive_price1_c = $request->exclusive_price1_c ;
            $exclusive_pv1_c = $request->exclusive_pv1_c ;
        }

        $input_data = [
            "name" => $request->name ?? null ,
            "description" => $request->description ?? null ,
            "name_en" => $request->name_en ?? null ,
            "description_en" => $request->description_en ?? null ,
            "code" => $request->code ?? null,
            "category" => $request->category ?? null,
            "category2" => $request->category2 ?? null,
            "kind" => $request->kind ?? null,
            "sort" => $request->sort ?? 9999,

            "price" => $request->price ?? 0 ,
            "tax" => $tax ?? 0 ,
            "pv" => $pv ?? 0 ,
            "pv2" => $request->pv2 ?? 0 ,
            "mem_price" => $request->mem_price ?? 0 ,
            "mem_pv" => $request->mem_pv ?? 0 ,
            "planer_price" => $planer_price ?? 0 ,
            "planer_pv" => $planer_pv ?? 0 ,
            "store_price" => $store_price ?? 0 ,
            "store_pv" => $store_pv ?? 0 ,
            "exclusive_price" => $exclusive_price ?? 0 ,
            "exclusive_pv" => $exclusive_pv ?? 0 ,
            "exclusive_price1" => $exclusive_price1 ?? 0 ,
            "exclusive_pv1" => $exclusive_pv1 ?? 0 ,

            "price_d" => $base_price_d ?? 0 ,
            "tax_d" => $tax_d ?? 0 ,
            "pv_d" => $pv_d ?? 0 ,
            "pv2_d" => $pv2_d ?? 0 ,
            "mem_price_d" => $request->price_d ?? 0 ,
            "mem_pv_d" => $request->pv_d ?? 0 ,
            "planer_price_d" => $planer_price_d ?? 0 ,
            "planer_pv_d" => $planer_pv_d ?? 0 ,
            "store_price_d" => $store_price_d ?? 0 ,
            "store_pv_d" => $store_pv_d ?? 0 ,
            "exclusive_price_d" => $exclusive_price_d ?? 0 ,
            "exclusive_pv_d" => $exclusive_pv_d ?? 0 ,
            "exclusive_price1_d" => $exclusive_price1_d ?? 0 ,
            "exclusive_pv1_d" => $exclusive_pv1_d ?? 0 ,


            "mem_price_y" => $base_price_y ?? 0 ,
            "mem_pv_y" => ($base_price_y * 0.1) ?? 0 ,
            "price_y" => $base_price_y ?? 0 ,
            "tax_y" => $tax_y ?? 0 ,
            "pv_y" => $pv_y ?? 0 ,
            "pv2_y" => $pv2_y ?? 0 ,
            "planer_price_y" => $planer_price_y ?? 0 ,
            "planer_pv_y" => $planer_pv_y ?? 0 ,
            "store_price_y" => $store_price_y ?? 0 ,
            "store_pv_y" => $store_pv_y ?? 0 ,
            "exclusive_price_y" => $exclusive_price_y ?? 0 ,
            "exclusive_pv_y" => $exclusive_pv_y ?? 0 ,
            "exclusive_price1_y" => $exclusive_price1_y ?? 0 ,
            "exclusive_pv1_y" => $exclusive_pv1_y ?? 0 ,

            "price_c" => $base_price_c ?? 0 ,
            "mem_price_c" => $request->mem_price_c ?? 0 ,
            "mem_pv_c" => $request->mem_pv_c ?? 0 ,
            "tax_c" => $tax_c ?? 0 ,
            "pv_c" => $pv_c ?? 0 ,
            "pv2_c" => $pv2_c ?? 0 ,
            "planer_price_c" => $planer_price_c ?? 0 ,
            "planer_pv_c" => $planer_pv_c ?? 0 ,
            "store_price_c" => $store_price_c ?? 0 ,
            "store_pv_c" => $store_pv_c ?? 0 ,
            "exclusive_price_c" => $exclusive_price_c ?? 0 ,
            "exclusive_pv_c" => $exclusive_pv_c ?? 0 ,
            "exclusive_price1_c" => $exclusive_price1_c ?? 0 ,
            "exclusive_pv1_c" => $exclusive_pv1_c ?? 0 ,

            "stock" => $request->stock ?? 0,
            "is_active" => $request->is_active ?? 'N',
            "is_fo_view" => $request->is_fo_view ?? 'N',
            "remark" => $request->remark ?? null,
            "content" => $request->content ?? null,
            "content_us" => $request->content_us ?? null,
            "content_jp" => $request->content_jp ?? null,
            "content_cn" => $request->content_cn ?? null,
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

        $query = ExDistribute::where('is_active','Y')->where('nation',$request->session()->get('member_nation'));

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('director_name', 'like', '%' . $search_text . '%')
                    ->orWhere('director_id', 'like', '%' . $search_text . '%')
                    ->orWhere('business_name', 'like', '%' . $search_text . '%')
                    ;
            });
        }

        $distributes = $query->orderBy('id', 'desc')->paginate($limitPage);

        $data = [
            "search_text" => $search_text ?? '',
            "distributes" =>  $distributes ?? [],
            "row_num" => $this->getPageRowNumber($distributes->total(), $page, $limitPage) ?? null,
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
            "bank_list" => (new CommonConstants)->getBankList(),
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
            "nation" => $request->session()->get('member_nation') ?? 'KR',
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
        return redirect()->route('erp-member.list');
    }

    
}
