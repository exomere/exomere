<?php

namespace App\Http\Controllers\FO;

use App\Models\ExItem;
use App\Models\ExCart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends BaseController
{

    public function index(Request $request)
    {


        $items = ExItem::where('is_fo_view','Y')->orderBy('sort', 'asc');

        foreach($items->get() as $item){
            $locale = app()->getLocale();

            $pd_name = $item->name_en;
            $pd_description = $item->description_en;

            if($locale == "ko"){
                $pd_name = $item->name;
                $pd_description = $item->description;
                $pd_price = $item->price;
                $price_simbol = "₩";
            }else{
                $pd_name = $item->name_en;
                $pd_description = $item->description_en;

                if($locale =="jp"){
                    $pd_price = $item->price_y;
                    $price_simbol = "¥";
                }else if($locale =="cn"){
                    $pd_price = $item->price_c;
                    $price_simbol = "¥";
                }else{
                    $pd_price = $item->price_d;
                    $price_simbol = "$";
                }
            }
            
            $products[] = [
                'id' => $item->id,
                'product_name' => $pd_name,
                'price' => $pd_price,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'thumbnail' => Storage::url('public/data/'.$item->thum_img),
                'thumbnail2' => Storage::url('public/data/'.$item->thum_img2),
                'brand' => 'exomere',
                'category' => $item->category2,
                'desc' => $item->content,
                'price_simbol' => $price_simbol,
                'sub_name' => $pd_description,
                'is_best' => true,
            ];
        }

        $categories = $this->category();

        $selectedCategory = request()->query('category') ?? null;

        $products = collect($products);

        if ($keyword = $request->get('search_keyword')) {
            $products = $products->filter(function ($item) use ($keyword) {
                return str_contains($item['product_name'], $keyword);
            });
        } else {
            $products = $products->whereNotNull('category');
        }

        $categorizeItems = $products->groupBy('category');


        $items = collect([
            'view_all' => $products,
            "toners_mists" => collect([]),
            "serums_essences" => collect([]),
            "creams" => collect([]),
            "sheet_masks" => collect([]),
            "cushions" => collect([]),
            "devices" => collect([]),
        ])->merge($categorizeItems);


        $productCount = $products->count();

        return view('pages.products.products', compact('categories', 'productCount', 'items', 'selectedCategory'));
    }

    public function productDetail($product_id)
    {
        // $products = collect($this->dummy());

        $product = ExItem::where('id', $product_id)->firstOrFail();

        return view('pages.products.detail', compact('product'));
    }

    public function bestProducts(): \Illuminate\Support\Traits\EnumeratesValues|\Illuminate\Support\Collection
    {
        $items = ExItem::where('kind','signature')->orderBy('sort', 'asc')->limit(6)->get();

        $bestItems = [];
        $locale = app()->getLocale();

        foreach($items as $item){
            $pd_name = $item->name_en;
            $pd_description = $item->description_en;

            if($locale == "ko"){
                $pd_name = $item->name;
                $pd_description = $item->description;
                $pd_price = $item->price;
                $price_simbol = "₩";
            }else{
                $pd_name = $item->name_en ?? $item->name;
                $pd_description = $item->description_en ?? $item->description;

                if($locale =="jp"){
                    $pd_price = $item->price_y;
                    $price_simbol = "¥";
                }else if($locale =="cn"){
                    $pd_price = $item->price_c;
                    $price_simbol = "¥";
                }else{
                    $pd_price = $item->price_d;
                    $price_simbol = "$";
                }
            }

            $bestItems[] = [
                'id' => $item->id,
                'product_name' => $pd_name,
                'price' => $pd_price,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'thumbnail' => Storage::url('public/data/'.$item->thum_img),
                'thumbnail2' => Storage::url('public/data/'.$item->thum_img2),
                'brand' => 'exomere',
                'price_simbol' => $price_simbol,
                'category' => $item->category,
                'desc' => $item->content,
                'sub_name' => $pd_description,
                'is_best' => true,
            ];
        }

        return collect($bestItems);
    }


    public function category()
    {
        return [
            "view_all",
            "toners_mists",
            "serums_essences",
            "creams",
            "sheet_masks",
            "cushions",
            "devices",
        ];
    }

    public function cartSave(Request $request){

        $mem_seq = $request->session()->get('member_seq');
        $cart_data = ExCart::where("member_seq",$mem_seq)->first();
        
        if($cart_data->seq){
            $cart_data->update([
                "pd_qty" => $cart_data->pd_qty + $request->pd_qty
            ]);
        }else{
            $save = [
                "member_seq" => $mem_seq,
                "pd_seq" => $request->pd_seq,
                "pd_name" => $request->id,
                "pd_price" => $request->id,
                "pd_pv" => $request->id,
                "pd_qty" => $request->pd_qty,
                "is_purchase" => 'N',
            ];
    
            ExCart::create($save);
        }


    }

}