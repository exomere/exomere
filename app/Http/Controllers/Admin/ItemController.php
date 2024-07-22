<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;

class ItemController extends Exomere
{

    protected $user;

    public function __construct()
    {
    }

    public function itemList(Request $request)
    {

        $items = ExItem::where('is_active', 'Y');
        $limitPage = $this->setPageLimit(40);
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $items->where('item_name','LIKE',"%{$request->get('search_text')}%");
        }
      
        $items->limit($limitPage)->orderBy('seq', 'desc');
        
        $data = [
          "search_text" => $search_text ?? '',
          "items" =>  $items ?? [],
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
            "item" => $item ?? [],
          ];
          return view('pages.item.register')->with($data);
    }

    public function itemSave(Request $request)
    {

          $symbols = [
            "base_price" => $request->base_symbol,
            "sale_price" => $request->sale_symbol,
            "cost_price" => $request->cost_symbol,
            "delivfee" => $request->delivfee_symbol,
            "coverfee" => $request->coverfee_symbol,
            "tax_price" => $request->tax_symbol,
            "deduct_price" => $request->deduct_symbol,
          ];

          $currency_symbols = json_encode($symbols);

          $input_data = [
            "site" => $request->site ?? 'GML',
            "item_name" => $request->item_name ?? null,
            "item_name_en" => $request->item_name_en ?? null,
            "item_unit" => $request->item_unit ?? null,
            "item_type" => $request->item_type ?? null,
            "item_group_a" => $request->item_group_a ?? null,
            "item_group_b" => $request->item_group_b ?? null,
            "item_group_c" => $request->item_group_c ?? null,
            "currency_symbols" => $currency_symbols ?? null,
            "base_price" => $request->base_price ?? 0,
            "sale_price" => $request->sale_price ?? 0,
            "cost_price" => $request->cost_price ?? 0,
            "maker" => $request->maker ?? null,
            "delivfee" => $request->delivfee ?? 0,
            "coverfee" => $request->coverfee ?? 0,
            "remark" => $request->remark ?? null,
            "sort" => $request->sort ?? 9999,
            "is_active" => $request->is_active ?? 'Y',
            "barcode" => $request->barcode ?? null,
            "tax_price" => $request->tax_price ?? 0,
            "deduct_price" => $request->deduct_price ?? 0,
            "currency_sale_price" => $request->currency_sale_price ?? 0,
            "currency_cost_price" => $request->currency_cost_price ?? 0,
            "currency_deduct_price" => $request->currency_deduct_price ?? 0,
            "is_discontinuance" => $request->is_discontinuance ?? 'N',
          ];

          ExItem::updateOrCreate(
            [
                "seq"=> $request->product_seq
            ],
            $input_data
          );

          return redirect('/product/list');
          
    }

    
}
