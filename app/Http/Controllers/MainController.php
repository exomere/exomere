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

        $request->session()->put('director_name', $director->director_name ?? '정성헌');
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
                $title = $banner->title_en;
                $sub_title = $banner->sub_title_en;
            }

            $mainVideoBanner[] = 
                [
                    'title' => $title,
                    'sub_title' => $sub_title,
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
                'code_en' => 'Patent: No. 10-2023-0121591',
                'code_jp' => '特許: 第10-2023-0121591号',
                'code_cn' => '专利:第10-2023-0121591号',
                'description' => '제주 한라봉에서 추출한 50~ 200mm 크기의 엑소좀으로, DNA, RNA, PEPTIDE가 포함되어 있어 노화 및 손상된 피부를 위한 세포 재생과 신호 전달에 도움을 주는 솔루션입니다.',
                'description_en' => 'It is an exosome extracted from Jeju Hallabong and contains DNA, RNA, and PEPTIDE, which helps cell regeneration and signaling for aging and damaged skin.',
                'description_cn' => '从济州丑橘中提取的50~200mm大小的外泌体，内含DNA、RNA、PEPTIDE，是帮助老化及受损肌肤的细胞再生与信号传达的解决方案。',
                'description_jp' => '済州ハルラボンから抽出した50～200nmのエクソソームで、DNA、RNA、ペプチドを含み、老化および損傷した肌の細胞再生と信号伝達を助けるソリューションです。',
                'image_src' => asset('assets/img/elements/about_technology_2.webp'),
            ],
            [
                'name' => 'SPICUS™',
                'code' => '특허: 제 10-2022-0007981호',
                'code_en' => 'Patent: No. 10-2022-0007981',
                'code_jp' => '特許: 第10-2022-0007981号',
                'code_cn' => '专利:第10-2022-0007981号',
                'description' => '청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
                'description_en' => 'It is a patented ingredient coated with gold silicate extract and bifida fermentants that promotes the production of vegetable collagen by refining pure ingredients of marine life extracted from clean seas, and fermented vegetable collagen coated on spikule penetrates the skin and improves it to elastic skin.',
                'description_jp' => '清浄な海から抽出された海洋生物由来の純粋な成分を精製し、植物性コラーゲン生成を促進する金花葵（キンカキュウ）抽出物とビフィダ発酵物でコーティングした特許成分です。スピキュールにコーティングされた発酵植物性コラーゲンが肌に浸透し、弾力のある肌へと改善します。',
                'description_cn' => '纯净海洋中提取的海洋生物的纯粹成分,以促进植物性胶原蛋白生成的黄蜀葵提取物和Bifida发酵物涂层专利成分,涂覆在微针上的发酵植物性胶原蛋白渗入肌肤,打造富有弹性的肌肤。',
                'image_src' => asset('assets/img/elements/about_technology_1.webp'),
            ]
        ];
        if ($locale != "ko") {
            foreach ($materials as &$material) {
                $material['description'] = $material['description_' . $locale];
                $material['code'] = $material['code_' . $locale];
            }
        }

        $bestProducts = app(ProductController::class)->bestProducts();
        $bestProducts = $bestProducts->toArray();

        return view(
            'pages.main',
            compact('mainVideoBanner', 'bestProducts', 'materials')
        );

        // return view('errors.503');
    }

}
