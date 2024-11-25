<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Exomere;
use App\Http\Controllers\FO\ProductController;
use App\Models\ExBanner;
use App\Models\ExDistribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class MainController extends Exomere
{
    public function index(Request $request)
    {
        $code = $request->code ?? 'exomere';

        $director = ExDistribute::where("code",$code)->first();

        $request->session()->put('director_name', $director->director_name ?? '정영철');
        $request->session()->put('director_company', $director->name ?? '(주)엑소미어');
        $request->session()->put('director_business_num', $director->business_num ?? '');
        $request->session()->put('director_phone', $director->director_phone ?? '02-1577-1586');
        $request->session()->put('director_address', $director->address ?? '서울 송파구 법원로11길 11 (문정동, 문정현대지식산업센터1-1) ');
        $request->session()->put('director_address_detail', $director->address_detail ?? 'A동 204호');
        $request->session()->put('director_code', $director->pg_code ?? '29151');

        $banners = ExBanner::where('is_active','Y')->get();
        $mainVideoBanner = [];
        $locale = app()->getLocale();
        foreach($banners as $banner){

            if($locale == "ko"){
                $title = $banner->title;
                $sub_title = $banner->sub_title;
            }else{
                $pd_name = $banner->title_en;
                $pd_description = $banner->sub_title_en;
            }

            $mainVideoBanner[] = 
                [
                    'title' => $banner->title,
                    'sub_title' => $banner->sub_title,
                    'type' => $banner->type,
                    'src' => asset( $banner->thumbnail),
                    'style' => ($banner->type == 'video') ? 'white' : 'black',
                ]
            ;
        } 
        
        $materials = [
            [
                'name' => 'Exomere Halla™',
                'code' => '특허: 제 10-2023-0121591호',
                'description' => '제주 한라봉에서 추출한 50~ 200mm 크기의 엑소좀으로, DNA, RNA, PEPTIDE가 포함되어 있어 노화 및 손상된 피부를 위한 세포 재생과 신호 전달에 도움을 주는 솔루션입니다.',
                'image_src' => asset('assets/img/elements/about_technology_2.webp'),
            ],
            [
                'name' => 'SPICUS™',
                'code' => '특허: 제 10-2022-0007981호',
                'description' => '청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
                'image_src' => asset('assets/img/elements/about_technology_1.webp'),
            ]
        ];

        $bestProducts = app(ProductController::class)->bestProducts();
        $bestProducts = $bestProducts->toArray();

        return view(
            'pages.main',
            compact('mainVideoBanner', 'bestProducts', 'materials')
        );

        // return view('errors.503');
    }

}
