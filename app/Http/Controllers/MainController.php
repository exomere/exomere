<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Exomere;
use App\Http\Controllers\FO\ProductController;
use App\Models\ExBanner;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class MainController extends Exomere
{

    public function index()
    {

        $banners = ExBanner::where('is_active','Y')->get();
        $mainVideoBanner = [];

        foreach($banners as $banner){
            $mainVideoBanner[] = 
                [
                    'title' => $banner->title,
                    'sub_title' => $banner->sub_title,
                    'type' => $banner->type,
                    'src' => asset( $banner->thumbnail),
                    'style' => ($banner->type == 'video') ? 'white' : 'black',
                    'link' => $banner->link ?? null
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
    }

}
