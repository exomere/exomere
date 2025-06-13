<?php

namespace App\Http\Controllers\FO;

use App\Models\ExItem;
use App\Models\ExCart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends BaseController
{

    public function index(Request $request)
    {
        $items = ExItem::where('is_fo_view', 'Y')->orderBy('sort', 'asc');

        foreach ($items->get() as $item) {
            $locale = app()->getLocale();

            $pd_name = $item->name_en;
            $pd_description = $item->description_en;

            if ($locale == "ko") {
                $pd_name = $item->name;
                $pd_description = $item->description;
                $pd_price = $item->price;
                $price_simbol = "₩";
            } else {
                $pd_name = $item->name_en;
                $pd_description = $item->description_en;

                if ($locale == "jp") {
                    $pd_price = $item->price_y;
                    $price_simbol = "¥";
                } else {
                    if ($locale == "cn") {
                        $pd_price = $item->price_c;
                        $price_simbol = "HK＄";
                    } else {
                        $pd_price = $item->price_d;
                        $price_simbol = "$";
                    }
                }
            }

            $products[] = [
                'id' => $item->id,
                'product_name' => $pd_name,
                'price' => $pd_price,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'thumbnail' => Storage::url('public/data/' . $item->thum_img),
                'thumbnail2' => Storage::url('public/data/' . $item->thum_img2),
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

    /**
     * 상품상세
     * @param ExItem $product
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
     */
    public function productDetail(ExItem $product): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $reviews = $product->reviews()
            ->withCount('likes')
            ->paginate($this->limit);

        foreach ($reviews as &$item) {
            //작성자 마스킹
            $item->author_name = Str::mask($item->author_name, '*', 1);

            // 로그인상태면 이미 좋아요 누른 리뷰인지 체크
            if (auth()->id()) {
                $item->liked = $item->likedByUser(auth()->id());
            } else {
                $item->liked = false;
            }
        }

        return view('pages.products.detail', compact('product','reviews'));
    }

    /**
     * 상품상세>리뷰
     * @param ExItem $product
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
     */
    public function getProductReviews(ExItem $product, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $page = $request->get('page') ?? $this->page;
        $limit = $request->get('limit') ?? $this->limit;

        $reviews = $product->reviews()
            ->withCount('likes')
            ->paginate($limit, ['*'], 'page', $page);

        foreach ($reviews as &$item) {
            //작성자 마스킹
            $item->author_name = Str::mask($item->author_name, '*', 1);

            // 로그인상태면 이미 좋아요 누른 리뷰인지 체크
            if (auth()->id()) {
                $item->liked = $item->likedByUser(auth()->id());
            } else {
                $item->liked = false;
            }
        }

        return view('pages.products.product_reviews', compact('reviews'));
    }


    public function setProductReviews(Request $request)
    {

    }


    public function bestProducts(): \Illuminate\Support\Traits\EnumeratesValues|\Illuminate\Support\Collection
    {
        $items = ExItem::where('kind', 'signature')->orderBy('sort', 'asc')->limit(6)->get();

        $bestItems = [];
        $locale = app()->getLocale();

        foreach ($items as $item) {
            $pd_name = $item->name_en;
            $pd_description = $item->description_en;

            if ($locale == "ko") {
                $pd_name = $item->name;
                $pd_description = $item->description;
                $pd_price = $item->price;
                $price_simbol = "₩";
            } else {
                $pd_name = $item->name_en ?? $item->name;
                $pd_description = $item->description_en ?? $item->description;

                if ($locale == "jp") {
                    $pd_price = $item->price_y;
                    $price_simbol = "¥";
                } else {
                    if ($locale == "cn") {
                        $pd_price = $item->price_c;
                        $price_simbol = "HK＄";
                    } else {
                        $pd_price = $item->price_d;
                        $price_simbol = "$";
                    }
                }
            }

            $bestItems[] = [
                'id' => $item->id,
                'product_name' => $pd_name,
                'price' => $pd_price,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'thumbnail' => Storage::url('public/data/' . $item->thum_img),
                'thumbnail2' => Storage::url('public/data/' . $item->thum_img2),
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

    public function cartSave(Request $request)
    {
        $mem_seq = $request->session()->get('member_seq');

        $cart_data = ExCart::where("member_seq", $mem_seq)->where("pd_seq", $request->pd_seq)->where(
            "is_purchase",
            'N'
        )->first();

        if (isset($cart_data->id)) {
            $cart_data->update([
                "pd_qty" => $request->pd_qty
            ]);
        } else {
            $save = [
                "member_seq" => $mem_seq,
                "pd_seq" => $request->pd_seq,
                "pd_qty" => $request->pd_qty,
                "is_purchase" => 'N',
            ];
            ExCart::create($save);
        }
    }

    public function myCart()
    {
        $exCarts = ExCart::where("member_seq", request()->session()->get('member_seq'))->where("is_purchase", 'N');
        $carts = [];
        $locale = app()->getLocale();
        foreach ($exCarts->get() as $cart) {
            $item_info = $cart->getItemInfo();

            if(!isset($item_info)) continue;

            $pd_name = $item_info->name_en ?? '';
            $pd_description = $item_info->description_en ?? '';

            if ($locale == "ko") {
                $pd_name = $item_info->name ?? '';
                $pd_description = $item_info->description ?? '';
                $pd_price = $item_info->price ?? 0;
                $price_simbol = "₩";


                if (request()->session()->get('member_position') == "총판") {
                    $pd_price = $item_info->exclusive_price ?? 0;
                    $pd_pv = $item_info->exclusive_pv ?? 0;
                }elseif (request()->session()->get('member_position') == "총판1") {
                    $pd_price = $item_info->exclusive_price1 ?? 0;
                    $pd_pv = $item_info->exclusive_pv1 ?? 0;
                } elseif (request()->session()->get('member_position') == "회원") {
                    $pd_price = $item_info->mem_price ?? 0;
                    $pd_pv = $item_info->mem_pv ?? 0;
                } elseif (request()->session()->get('member_position') == "뷰티플래너") {
                    $pd_price = $item_info->planer_price ?? 0;
                    $pd_pv = $item_info->planer_pv ?? 0;
                } elseif (request()->session()->get('member_position') == "대리점") {
                    $pd_price = $item_info->store_price ?? 0;
                    $pd_pv = $item_info->store_pv ?? 0;
                } else {
                    $pd_price = $item_info->exclusive_price ?? 0;
                    $pd_pv = $item_info->exclusive_pv ?? 0;
                }
            } else {
                $pd_name = $item_info->name_en ?? $item_info->name;
                $pd_description = $item_info->description_en ?? $item_info->description;

                if ($locale == "jp") {
                    $pd_price = $item_info->price_y;
                    $pd_pv = $item_info->pv_y;
                    $price_simbol = "¥";

                    if (request()->session()->get('member_position') == "총판") {
                        $pd_price = $item_info->exclusive_price_y;
                        $pd_pv = $item_info->exclusive_pv_y;
                    }elseif (request()->session()->get('member_position') == "총판1") {
                        $pd_price = $item_info->exclusive_price1_y;
                        $pd_pv = $item_info->exclusive_pv1_y;
                    } elseif (request()->session()->get('member_position') == "회원") {
                        $pd_price = $item_info->mem_price_y;
                        $pd_pv = $item_info->mem_pv_y;
                    } elseif (request()->session()->get('member_position') == "뷰티플래너") {
                        $pd_price = $item_info->planer_price_y;
                        $pd_pv = $item_info->planer_pv_y;
                    } elseif (request()->session()->get('member_position') == "대리점") {
                        $pd_price = $item_info->store_price_y;
                        $pd_pv = $item_info->store_pv_y;
                    } else {
                        $pd_price = $item_info->exclusive_price_y;
                        $pd_pv = $item_info->exclusive_pv_y;
                    }

                } else {
                    if ($locale == "cn") {
                        $pd_price = $item_info->price_c;
                        $pd_pv = $item_info->pv_c;
                        $price_simbol = "HK＄";

                        if (request()->session()->get('member_position') == "총판") {
                            $pd_price = $item_info->exclusive_price_c;
                            $pd_pv = $item_info->exclusive_pv_c;
                        }elseif (request()->session()->get('member_position') == "총판1") {
                            $pd_price = $item_info->exclusive_price1_c;
                            $pd_pv = $item_info->exclusive_pv1_c;
                        } elseif (request()->session()->get('member_position') == "회원") {
                            $pd_price = $item_info->mem_price_c;
                            $pd_pv = $item_info->mem_pv_c;
                        } elseif (request()->session()->get('member_position') == "뷰티플래너") {
                            $pd_price = $item_info->planer_price_c;
                            $pd_pv = $item_info->planer_pv_c;
                        } elseif (request()->session()->get('member_position') == "대리점") {
                            $pd_price = $item_info->store_price_c;
                            $pd_pv = $item_info->store_pv_c;
                        } else {
                            $pd_price = $item_info->exclusive_price_c;
                            $pd_pv = $item_info->exclusive_pv_c;
                        }

                    } else {
                        $pd_price = $item_info->price_d;
                        $pd_pv = $item_info->pv_d;
                        $price_simbol = "$";

                        if (request()->session()->get('member_position') == "총판") {
                            $pd_price = $item_info->exclusive_price_d;
                            $pd_pv = $item_info->exclusive_pv_d;
                        }elseif (request()->session()->get('member_position') == "총판1") {
                            $pd_price = $item_info->exclusive_price1_d;
                            $pd_pv = $item_info->exclusive_pv1_d;
                        } elseif (request()->session()->get('member_position') == "회원") {
                            $pd_price = $item_info->mem_price_d;
                            $pd_pv = $item_info->mem_pv_d;
                        } elseif (request()->session()->get('member_position') == "뷰티플래너") {
                            $pd_price = $item_info->planer_price_d;
                            $pd_pv = $item_info->planer_pv_d;
                        } elseif (request()->session()->get('member_position') == "대리점") {
                            $pd_price = $item_info->store_price_d;
                            $pd_pv = $item_info->store_pv_d;
                        } else {
                            $pd_price = $item_info->exclusive_price_d;
                            $pd_pv = $item_info->exclusive_pv_d;
                        }
                    }
                }
            }

            $carts[] =
            [
                'id' => $item_info->id,
                'product_name' => $pd_name,
                'distribution_price' => $pd_price,
                'price_simbol' => $price_simbol,
                'pv' => $pd_pv,
                'thumbnail' => Storage::url('public/data/' . $item_info->thum_img),
                'sub_name' => $pd_description,
                'quantity' => $cart->pd_qty,
            ];
        }

        $datas = [
            "carts" => $carts,
        ];

        return view('pages.mypage.cart')->with($datas);
    }


    /**
     * todo 장바구니 단건 삭제
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartDelete($id): \Illuminate\Http\JsonResponse
    {
        ExCart::where("member_seq", request()->session()->get('member_seq'))
            ->where('pd_seq', $id)
            ->where("is_purchase", 'N')
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * todo 장바구니 선택 삭제
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartDeleteSelected(Request $request): \Illuminate\Http\JsonResponse
    {
        ExCart::where("member_seq", request()->session()->get('member_seq'))
            ->whereIn('pd_seq', $request->ids)
            ->where("is_purchase", 'N')
            ->delete();

        return response()->json(['success' => true]);
    }


}