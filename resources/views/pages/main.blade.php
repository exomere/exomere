@extends('pages.layouts.app')

@section('title', '홈페이지')

@push('styles')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    <main id="container" ap-type="content"><h1>Prime Skin Revealed by Absolute Performance</h1>
        <article id="content"><!-- KV -->
            <section class="main_keyvisual">
                <div class="main_kv_swiper">
                    <div class="swiper-wrapper" aria-live="off">
                        <div class="swiper-slide" data-col="dark" data-swiper-slide-index="1" role="group"
                             aria-label="2 / 2" style="width: 2111px;">
                            <div class="text_info"><strong class="title"><span
                                            lang="en">ONE DROP, ONE NIGHT REBORN</span></strong>
                                <p>프라임 리저브 리트리니티 세럼</p><a
                                        href="https://www.ap-beauty.com/kr/ko/product/prime-reserve-retrinity-serum.html"
                                        target="_self" ap-click-area="Main" ap-click-name="Click – Main Visual"
                                        ap-click-data="프라임 리저브 리트리니티 세럼" tabindex="-1">THE MORE</a></div>
                            <div class="video dark"><!-- 영상어두운 경우 dark class명 반영 -->
                                <video src="https://amc.apglobal.com/asset/384224417642/video_kc98rnjmgt0sj2tpcvbt77up7h?content-disposition=inline"
                                       poster="https://amc.apglobal.com/image/384224417642/image_mahn6lr4ot6ol46chpq4fr3q40/-FJPG"
                                       autoplay="" muted="" playsinline="" loop="">ONE DROP, ONE NIGHT REBORN
                                </video>
                                <div class="voddescription">ONE DROP, ONE NIGHT REBORN</div>
                            </div>
                        </div>
                        <div class="swiper-slide" data-col="" data-swiper-slide-index="0" role="group"
                             aria-label="1 / 2" style="width: 2111px;">
                            <div class="text_info"><strong class="title">클리니컬<sup>1</sup> 듀얼 액션, 리페어 &amp; 리프트</strong>
                                <p>듀얼 리페어 리프트 크림</p><a
                                        href="https://www.ap-beauty.com/kr/ko/product/dual-repair-lift-cream.html"
                                        target="_self" ap-click-area="Main" ap-click-name="Click – Main Visual"
                                        ap-click-data="듀얼 리페어 리프트 크림" tabindex="0">THE MORE</a></div>
                            <div class="video"><!-- 영상어두운 경우 dark class명 반영 -->
                                <video src="https://www.ap-beauty.com/kr/ko/adm/main/kv/__icsFiles/afieldfile/2024/01/12/MD_Web_Main_10s_4K_v240112_1.mp4"
                                       poster="https://amc.apglobal.com/image/384224417642/image_mahn6lr4ot6ol46chpq4fr3q40/-FJPG"
                                       autoplay="" muted="" playsinline="" loop="">클리니컬 듀얼 액션, 리페어 &amp; 리프트
                                </video>
                                <div class="voddescription">클리니컬 듀얼 액션, 리페어 &amp; 리프트</div>
                            </div>
                        </div>
                    </div>
                    <div class="main_kv_controller">
                        <div class="main_kv_pagination swiper-pagination-custom swiper-pagination-horizontal"><span
                                    class="num_current">01</span><span class="num_total">02</span></div>
                        <div class="main_kv_progress_bar"><p class="active" style="transition-duration: 10000ms;"></p>
                            <p style="transition-duration: 0ms;" class=""></p></div>
                        <button class="main_kv_pause">PAUSE</button>
                    </div>
                    <div class="main_kv_arrowkey">
                        <button class="main_kv_prev" tabindex="0" aria-label="Previous slide">prev</button>
                        <button class="main_kv_next" tabindex="0" aria-label="Next slide">next</button>
                    </div>
                    <button class="btn_scroll">Scroll</button>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            </section><!-- // KV --><!-- RECOMMENDED PRODUCTS -->
            <section class="products scroll_ani" id="recommend_product">
                <div class="scroll_positon"></div>
                <h2><p>RECOMMENDED PRODUCTS</p></h2>
                <ul class="product_list1" id="main_product">
                    <li class="product_item"><a
                                href="https://www.ap-beauty.com/kr/ko/product/dual-repair-lift-cream.html?option=50 ml / 1.6 fl. oz."
                                ap-click-area="Product" ap-click-name="click Product Detail Link"
                                ap-click-data="듀얼 리페어 리프트 크림">            <!-- 썸네일 이미지 -->
                            <div class="img"><img
                                        src="http://exomere.co.kr/common/image/main_core_flipFrontBg01.png"
                                        alt="Dual Repair lift cream">                <!-- 마우스오버 이미지 --> <span>                    <img
                                            src="//www.ap-beauty.com/kr/ko/product/__icsFiles/afieldfile/2024/01/08/240105_NEWAP_PLP_MD-Cream_02.jpg"
                                            alt="듀얼 리페어 리프트 크림의 제형">                </span></div><!-- 제품 정보 -->
                            <div class="info">            <!-- flag 최대 2개 노출 -->
                                <ul class="flag">
                                    <li>BEST</li>
                                </ul>            <!-- 제품명 --> <p class="name">
                                    <!-- 라인명 --><strong>M.D.</strong>                <!-- 제품명 --> <strong>듀얼 리페어 리프트
                                        크림</strong></p><!-- 원포인트 문구 --> <em>피부 특수 케어 기술을 접목한 고효능의 압도적인 듀얼 리페어 &amp; 리프팅
                                    크림</em></div>
                        </a></li>
                    <li class="product_item"><a
                                href="https://www.ap-beauty.com/kr/ko/product/lift-renew-double-shot-program.html?option=(Poids net 0.9 g + 10 g) X3 / (Net wt. 0.03 oz. + 0.3 oz.) X3"
                                ap-click-area="Product" ap-click-name="click Product Detail Link"
                                ap-click-data="리프트 앤 리뉴 더블 샷 프로그램">            <!-- 썸네일 이미지 -->
                            <div class="img"><img
                                        src="//www.ap-beauty.com/kr/ko/product/__icsFiles/afieldfile/2024/01/12/240112_NEWAP_PLP_MD-Cream.jpg"
                                        alt="Lift &amp; Renew Double Shot Program">
                                <!-- 마우스오버 이미지 --><span>                    <img
                                            src="//www.ap-beauty.com/kr/ko/product/__icsFiles/afieldfile/2024/01/08/240105_NEWAP_PLP_MD-Cream_02.jpg"
                                            alt="리프트 앤 리뉴 더블 샷 프로그램의 제형">                </span></div><!-- 제품 정보 -->
                            <div class="info">            <!-- flag 최대 2개 노출 -->
                                <ul class="flag">
                                    <li>BEST</li>
                                </ul>            <!-- 제품명 --> <p class="name">
                                    <!-- 라인명 --><strong>M.D.</strong>                <!-- 제품명 --> <strong>리프트 앤 리뉴 더블 샷
                                        프로그램</strong></p>            <!-- 원포인트 문구 --> <em>피부 속 탄력부터, 주름, 모공까지 강력하게 리뉴얼
                                    시켜주는 앰플 프로그램</em></div>
                        </a></li>
                    <li class="product_item"><a
                                href="https://www.ap-beauty.com/kr/ko/product/firming-radiance-plumping-lotion.html?option=150 ml / 5.0 fl. oz."
                                ap-click-area="Product" ap-click-name="click Product Detail Link"
                                ap-click-data="퍼밍 앤 래디언스 플럼핑 로션">            <!-- 썸네일 이미지 -->
                            <div class="img"><img
                                        src="//www.ap-beauty.com/kr/ko/product/__icsFiles/afieldfile/2024/01/12/240112_NEWAP_PLP_MD-Cream.jpg"
                                        alt="Firming &amp; Radiance Plumping Lotion">
                                <!-- 마우스오버 이미지 --><span>                    <img
                                            src="//www.ap-beauty.com/kr/ko/product/__icsFiles/afieldfile/2024/01/08/240105_NEWAP_PLP_MD-Cream_02.jpg"
                                            alt="퍼밍 앤 래디언스 플럼핑 로션의 제형">                </span></div><!-- 제품 정보 -->
                            <div class="info">            <!-- flag 최대 2개 노출 -->
                                <ul class="flag">
                                    <li>NEW</li>
                                </ul>            <!-- 제품명 --> <p class="name">
                                    <!-- 라인명 --><strong>M.D.</strong>                <!-- 제품명 --> <strong>퍼밍 앤 래디언스 플럼핑
                                        로션</strong></p>            <!-- 원포인트 문구 --> <em>피부 특수 케어 기술로 즉각적인
                                    플럼핑<sup>1</sup>과 광채 넘치는 탄력 피부를 선사하는 리페어 로션</em></div>
                        </a></li>
                </ul>
            </section><!-- // RECOMMENDED PRODUCTS -->
            <!-- The icon -->
            {{--<section class="banner_item scroll_ani_half bright right " >
                <div class="layout_inner">
                    <div class="text_info"><h2>듀얼 리페어 리프트 크림</h2>
                        <p>피부 특수 케어 성분과 기술을 융합한 고성능 안티에이징 솔루션</p><a
                                href="https://www.ap-beauty.com/kr/ko/product/dual-repair-lift-cream.html"
                                target="_self" class="btn_more" ap-click-area="Main" ap-click-name="Click – Banner"
                                ap-click-data="듀얼 리페어 리프트 크림">THE MORE</a></div>
                    <div class="img"><!--pc이미지--><img
                                src="//www.ap-beauty.com/kr/ko/adm/main/the-icon/__icsFiles/afieldfile/2024/01/12/Banner_MD_KV_v2.jpg"
                                alt="듀얼 리페어 리프트 크림" class="only_pc"><!--mo이미지--><img
                                src="//www.ap-beauty.com/kr/ko/adm/main/the-icon/__icsFiles/afieldfile/2024/01/12/Banner_MD_KV_v2_MO.png"
                                alt="듀얼 리페어 리프트 크림" class="only_mobile"></div>
                </div>
            </section>
            <section class="banner_item scroll_ani_half bright">
                <div class="layout_inner">
                    <div class="text_info"><h2>리프트 앤 리뉴 더블 샷 프로그램</h2>
                        <p>피부 근원인 콜라겐 매트릭스 리뉴얼로 탄력부터 모공까지 강력한 피부 리뉴얼</p><a
                                href="https://www.ap-beauty.com/kr/ko/product/lift-renew-double-shot-program.html"
                                target="_self" class="btn_more" ap-click-area="Main" ap-click-name="Click – Banner"
                                ap-click-data="리프트 앤 리뉴 더블 샷 프로그램">THE MORE</a></div>
                    <div class="img"><!--pc이미지--><img
                                src="//www.ap-beauty.com/kr/ko/adm/main/the-icon/__icsFiles/afieldfile/2023/12/28/231219_NEWAP_Main_Banner-Program_PC.jpg"
                                alt="리프트 앤 리뉴 더블 샷 프로그램" class="only_pc"><!--mo이미지--><img
                                src="//www.ap-beauty.com/kr/ko/adm/main/the-icon/__icsFiles/afieldfile/2023/12/28/231219_NEWAP_Main_Banner-Program_MO.jpg"
                                alt="리프트 앤 리뉴 더블 샷 프로그램" class="only_mobile"></div>
                </div>
            </section><!-- // The icon --><!-- ABSOLUTE PERFORMANCE -->
            <section class="banner_item collection scroll_ani_half dark right">
                <div class="layout_inner">
                    <div class="text_info"><h2>프라임 리저브 리트리니티 세럼</h2>
                        <p>탄력에 기반해 오래 지속되는 안티에이징 솔루션</p><a
                                href="https://www.ap-beauty.com/kr/ko/product/prime-reserve-retrinity-serum.html"
                                target="_self" class="btn_more" ap-click-area="Main" ap-click-name="Click – Banner"
                                ap-click-data="프라임 리저브 리트리니티 세럼">THE MORE</a></div>
                    <div class="img"><!--pc이미지--><img
                                src="https://amc.apglobal.com/image/384224417642/image_bacf3o167t1rjfbf20kriopp41/-FJPG"
                                alt="프라임 리저브 리트리니티 세럼" class="only_pc"><!--mo이미지--><img
                                src="https://amc.apglobal.com/image/384224417642/image_1mqkkvppqd6epei7td4flvjs5a/-FJPG"
                                alt="프라임 리저브 리트리니티 세럼" class="only_mobile"></div>
                </div>
            </section>--}}

            <!-- // ABSOLUTE PERFORMANCE -->

            <!-- 브랜드섹션묶음 -->
            <section><!-- BRAND ORIGINALITY -->
                <div class="key_line scroll_ani">
            {{--        <h2><p>APEX OF SKINCARE</p></h2>
                    <div class="text_info">
                        <ul class="title trigger_txt">
                            <li><h3><span>새로운 차원의 피부 과학 기술</span></h3></li>
                        </ul>
                        <p class="trigger_txt2">화장품 영역에 국한되지 않는 폭넓은 연구와 <br class="only_pc">글로벌 전문 기관과의 협력을 통해 피부 과학의
                            혁신을 선도합니다.</p>
                    </div>--}}
                    <div class="video">
                        <video src="//exomere.co.kr/common/image/exomere.mp4"
                               muted="" autoplay="" loop="" playsinline="">{{--APEX OF SKINCARE--}}
                        </video>
                    </div>
                </div><!-- // BRAND ORIGINALITY -->


                <!-- Clinically Proven Results -->
               {{-- <div class="clinocally scroll_ani">
                    <div class="title"><h3>독자 특허 성분</h3>
                        <p>아주 작고 정밀한 단위에서부터 <br class="only_mo">연구하여 탄생시킨 독자 성분들은 <br>한계를 뛰어넘는 압도적 효능과 피부 변화를 제공합니다.</p>
                    </div>
                    <div class="imgs">
                        <div><img src="//www.ap-beauty.com/kr/ko/resource/images/main/main-brandStory_01_kr_231227.jpg"
                                  alt="독자 특허 성분"></div>
                        <div><img src="//www.ap-beauty.com/kr/ko/resource/images/main/main-brandStory_01_kr_231227.jpg"
                                  alt="독자 특허 성분"></div>
                        <div><img src="//www.ap-beauty.com/kr/ko/resource/images/main/main-brandStory_01_kr_231227.jpg"
                                  alt="독자 특허 성분"></div>
                    </div>
                </div>--}}
                <!-- // Clinically Proven Results -->


                <!-- banner -->
                <div class="banner_item center scroll_ani_half bn2">
                    <div class="text_info"><h3>결과를 검증하는 클리니컬 테스트</h3>
                        <p>쌍둥이 대상, 특수 케어 영감 인체적용시험 등 선도적인 테스트 방식은 <br class="only_pc">고성능 안티에이징 효능과 새로운 차원의 피부 결과를
                            검증합니다.</p><a href="https://www.ap-beauty.com/kr/ko/discover/our-story.html" class="btn_more"
                                         ap-click-area="Main" ap-click-name="Click – Banner"
                                         ap-click-data="결과를 검증하는 클리니컬 테스트">THE MORE</a></div>
                    <span class="img"><img src="" alt="결과를 검증하는 클리니컬 테스트"></span></div>
                <!-- // banner -->
            </section>
            <!-- // 브랜드섹션묶음 --><!-- OUR SERVICES -->
            <section class="ourservices">
                <div class="layout_inner">
                    <div class="etcservices scroll_ani">
                        <div class="title"><h2>OUR SERVICES</h2></div>
                        <div class="etcservices_swiper    ">
                            <div class="swiper-wrapper" aria-live="polite"
                                 style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3"
                                     style="width: 560px; margin-right: 40px;"><p class="img"><img
                                                src="//www.ap-beauty.com/kr/ko/adm/main/service/services/__icsFiles/afieldfile/2023/12/28/231219_NEWAP_Main_OurServices_560x560_1.jpg"
                                                alt="피부 컨설테이션"></p><span>피부 컨설테이션</span></div>
                                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 3"
                                     style="width: 560px; margin-right: 40px;"><p class="img"><img
                                                src="//www.ap-beauty.com/kr/ko/adm/main/service/services/__icsFiles/afieldfile/2023/12/28/231219_NEWAP_Main_OurServices_560x560_1.jpg"
                                                alt="AP 스파"></p><span>AP 스파</span></div>
                                <div class="swiper-slide" role="group" aria-label="3 / 3"
                                     style="width: 560px; margin-right: 40px;"><p class="img"><img
                                                src="//www.ap-beauty.com/kr/ko/adm/main/service/services/__icsFiles/afieldfile/2023/12/28/231219_NEWAP_Main_OurServices_560x560_1.jpg"
                                                alt="시그니처 기프트 포장"></p><span>시그니처 기프트 포장</span></div>
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                        <a href="https://www.ap-beauty.com/kr/ko/discover/our-service.html" target="_self"
                           ap-click-area="Main" ap-click-name="Click – Banner"
                           ap-click-data="https://www.ap-beauty.com/kr/ko/discover/our-service.html">THE MORE</a></div>
                </div>
            </section><!-- // OUR SERVICES --></article>
    </main>
@endsection

@push('scripts')
    <script> var main_kv_time = 10000;</script>
    <script defer src="{{ asset('assets/js/fo/main.js') }}"></script>
@endpush