<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExOrder;
use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use App\Models\ExItemStock;
use App\Models\ExItemStockLog;

class ErpStockController extends Exomere
{

    public function stockList(Request $request)
    {

        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;
        $date_array = [];
        $s_date = $request->s_date ?? date('Y-m-01');
        $e_date = $request->e_date ?? date('Y-m-d');

        //검색 날짜별 갭 데이터를 구함 (뿌려주는 데이터를 정해주기 위함)
        $gap_day = $this->gap_day($s_date, $e_date);

        for ($i = 0; $i < $gap_day; $i++) {
            $date_array[] = date('m-d', strtotime($s_date . " +" . $i . " day"));
        }

        $site_code = $request->session()->get('site_code') ?? "exomere";

        $query = ExItem::where("is_active", 'Y');

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%');
            });
        }
        $items = $query->pluck('id', 'name');

        $date_item_array = [];
        $itemStocks = ExItemStockLog::whereIn('item_seq', $items)
            ->whereBetween('stock_date', [$s_date, $e_date])
            ->selectRaw('item_seq, stock_date, SUM(target_stock) as total_stock, type')
            ->groupBy('item_seq', 'stock_date', 'type')
            ->get();

        $item_stock_data = ExItemStock::all();

        foreach ($item_stock_data as $stock_data) {
            $item_stock[$stock_data->item_seq] = $stock_data->stock;
        }

        foreach ($items as $itemId) {
            $date_item_array[$itemId] = [];
        }

        foreach ($itemStocks as $stock) {
            $date = date('m-d', strtotime($stock->stock_date));
            $type = ($stock->type == 'P') ? 'P' : 'M';

            if ($type == 'M') {
                $date_item_array[$stock->item_seq][$date] = ($date_item_array[$stock->item_seq][$date] ?? 0) + $stock->total_stock;
                $date_item_array[$stock->item_seq]['total'] = ($date_item_array[$stock->item_seq]['total'] ?? 0) + $stock->total_stock;
            } else {
                $date_item_array[$stock->item_seq]['receiving'] = ($date_item_array[$stock->item_seq]['receiving'] ?? 0) + $stock->total_stock;
            }

        }
        // dd($date_item_array);
        // 데이터 배열에 변수 담기
        $data = [
            "date_array" => $date_array,
            "date_item_array" => $date_item_array,
            "items" => $items,
            "item_stock" => $item_stock,
        ];

        return view('pages.erp.stock.list')->with($data);
    }

    private function gap_day($start_time, $end_time)
    {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);

        $diff = $end_time - $start_time;
        $day = floor($diff / 86400) + 1;

        return $day;
    }

    public function stockSave(Request $request){

        set_time_limit(300);
        $stock_data = ExItemStock::where('item_seq', $request->item_seq)->first();

        $now_stock = $stock_data->stock ?? 0;

        $after_stock = $now_stock;

        if($request->stock_type == 'M'){
            $now_stock = $after_stock - $request->stock;
        }else{
            $now_stock = $after_stock + $request->stock;
        }
        
        $update_data['stock'] = $now_stock ?? 0;

        ExItemStockLog::create([
            "stock_seq" => $stock_data->id ?? 0,
            "item_seq" => $request->item_seq,
            "stock_date" => $request->stock_date,
            "type" => $request->stock_type,
            "after_stock" => $after_stock,
            "target_stock" => $request->stock,
            "before_stock" => $now_stock,
            "remark" => $request->remark,
        ]);

        $stock_data->update($update_data);
        
        return redirect()->route('basic-layouts-stock-list');
    }

    public function stockManager($order_seq){
        
        $order = ExOrder::find($order_seq);

        $item_info = json_decode($order->item_info);
        
        foreach($item_info as $info){
            $stock_data = ExItemStock::where('item_seq', $info->pd_seq)->first();

            $now_stock = $stock_data->stock ?? 0;
    
            $after_stock = $now_stock ?? 0;

            $now_stock = $after_stock - $info->pd_qty ?? 0;
                
            $update_data['stock'] = $now_stock ?? 0;
            
            if(!isset($stock_data->id)) continue;

            ExItemStockLog::create([
                "stock_seq" => $stock_data->id ?? 0,
                "item_seq" => $info->pd_seq,
                "stock_date" => $order->order_date,
                "type" => "M",
                "etc_seq" => $order->id,
                "after_stock" => $after_stock,
                "target_stock" => $info->pd_qty,
                "before_stock" => $now_stock,
                "remark" => "",
            ]);

            $stock_data->update($update_data);
        };

    }

    public function register(){
        $query = ExItem::where("is_active", 'Y');
        $items = $query->pluck('id', 'name');

        $data = [
            "items" => $items,
        ];

        return view('pages.erp.stock.register')->with($data);
    }
}
