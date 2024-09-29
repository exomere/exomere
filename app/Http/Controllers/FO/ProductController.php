<?php

namespace App\Http\Controllers\FO;

use Illuminate\Http\Request;

class ProductController extends BaseController
{

    public function index(Request $request)
    {
        $categories = $this->category();

        $selectedCategory = request()->query('category') ?? null;

        $products = collect($this->dummy());

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
        ])->merge($categorizeItems);


        $productCount = $products->count();

        return view('pages.products.products', compact('categories', 'productCount', 'items', 'selectedCategory'));
    }

    public function productDetail($product_id)
    {
        $products = collect($this->dummy());

        $product = $products->where('id', $product_id)->firstOrFail();

        return view('pages.products.detail', compact('product'));
    }

    public function bestProducts(): \Illuminate\Support\Traits\EnumeratesValues|\Illuminate\Support\Collection
    {
        return collect($this->dummy())->where('is_best', true);
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
        ];
    }

    public function dummy()
    {
        return [
            [
                'id' => 1,
                'product_name' => '리프팅샷 수딩젤 100g',
                'price' => 66000,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'creams',
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],
            [
                'id' => 2,
                'product_name' => '퍼펙트 스칼프 임플란트 세럼',
                'price' => 39000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'serums_essences',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],
            [
                'id' => 3,
                'product_name' => 'EXO-AG 리셀솔루션4SET',
                'price' => 220000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'serums_essences',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],
            [
                'id' => 4,
                'product_name' => '퍼펙트 스칼프 토너',
                'price' => 39000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'toners_mists',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],

            [
                'id' => 5,
                'product_name' => '임플라힐 P.O 크림',
                'price' => 37000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'imlaheal',
                'category' => null,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],
            [
                'id' => 6,
                'product_name' => '에델바이스 스노우크림',
                'price' => 40000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ],
            [
                'id' => 7,
                'product_name' => '티트리 버블 클렌져',
                'price' => 28000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'return10',
                'category' => null,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 8,
                'product_name' => 'AC미라클 힐러',
                'price' => 35000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'time72',
                'category' => null,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 9,
                'product_name' => '미라클 스폰질라(M)',
                'price' => 22000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'time72',
                'category' => null,
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 10,
                'product_name' => '세라마이드 리셀크림',
                'price' => 99000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'creams',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 11,
                'product_name' => '에델바이스스노우크림',
                'price' => 50000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'creams',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 12,
                'product_name' => '아로마 힐링미스트 50ml',
                'price' => 25000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'toners_mists',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 13,
                'product_name' => '아로마 힐링미스트 150ml',
                'price' => 55000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'toners_mists',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 14,
                'product_name' => '글루타치온 멜라샷 솔루션',
                'price' => 99000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'creams',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 15,
                'product_name' => '리커버리밤 플러스',
                'price' => 52000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'cushions',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 16,
                'product_name' => '리커버리밤 플러스(리필)',
                'price' => 40000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 17,
                'product_name' => '임플란트솔루션(H)',
                'price' => 66000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'exomere',
                'category' => 'creams',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
            ],
            [
                'id' => 18,
                'product_name' => '로즈가든마스크팩',
                'price' => 45000,
                'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
                'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
                'brand' => 'return10',
                'category' => 'sheet_masks',
                'distribution_price' => 22500,
                'vat_excluded' => 20455,
                'total_price' => 22500,
                'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
                'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
                'is_best' => true,
            ]
        ];
    }

}