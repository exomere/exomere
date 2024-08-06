<header id="header" class="absolute inset-x-0 top-0 z-50 bg-transparent">
    <div class="header_wrap">
        <div class="gnb">
            {{--language--}}
            <div class="language_select">
                <button class="language_button">

                    {{ config('meta.languages.'.app()->getLocale())  ?? strtoupper(app()->getLocale())  }}

                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                         class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                    </svg>

                </button>
                <ul class="language_list">
                    @foreach(array_keys(config('meta.languages')) as $lang)
                        <li class="{{ app()->getLocale() == $lang ? 'active' : '' }}"><a
                                href="{{ route('setLanguage', ['lang' => $lang]) }}"
                                lang="{{ $lang }}">{{ config('meta.languages.'.$lang) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!--logo-->
            <h1><a href="/" class="logo"><span class="sr-only">엑소미어</span></a></h1>


            {{--login/search--}}
            <div>
                <a href="/login" target="_blank" class="myoffice_button font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    My Office
                </a>
                <button type="button" class="gnb_search_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                         class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                    <span class="sr-only">검색</span>
                </button>
            </div>
        </div>

        <div class="nav">
            <ul class="nav_1deps">
                <li class="nav_1deps_item">
                    <a href="/about">ABOUT US</a>
                    <ul class="lnb">
                        <li>
                            <a href="/about">기업소개</a>
                            <ul class="lnb_sub">
                                <li><a href="/about">기업소개</a></li>
                                <li><a href="/about/philosophy">경영이념</a></li>
                                <li><a href="/about/history">연혁</a></li>
                                <li><a href="/about/cibi">CI/BI 소개</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/about/core">R&D</a>
                            <ul class="lnb_sub">
                                <li><a href="/about/core">핵심 성분</a></li>
                                <li><a href="/about/technology">특허 기술</a></li>
                            </ul>
                        </li>
                        <li><a href="/about/branch">Branch</a></li>
                    </ul>
                </li>

                <li class="nav_1deps_item">
                    <a href="/newsandmedia/news">NEWS <span class="ampersand">&amp;</span> MEDIA</a>
                    <ul class="lnb">
                        <li><a href="/newsandmedia/news">언론보도</a></li>
                        <li><a href="/newsandmedia/videos">브랜드 영상</a></li>
                    </ul>
                </li>
                <li class="nav_1deps_item">
                    <a href="/brand">BRAND</a>
                    <ul class="lnb">
                        <li><a href="/brand">EXOMERE™</a></li>
                        <li><a href="/brand/return10">RETURN10</a></li>
                        <li><a href="/brand/time72">TIME72</a></li>
                        <li><a href="/brand/imlaheal">IMLAHeal</a></li>
                    </ul>
                </li>
                <li class="nav_1deps_item">
                    <a href="/products">PRODUCT</a>
                    <ul class="lnb">
                        <li>
                            <a href="/products">카테고리별</a>
                            <ul class="lnb_sub">
                                <li><a href="/products">전체보기</a></li>
                                <li><a href="/products/category=">토너 & 미스트 </a></li>
                                <li><a href="/products/category=">세럼 & 에센스 </a></li>
                                <li><a href="/products/category=">크림 </a></li>
                                <li><a href="/products/category=">마스크팩 </a></li>
                                <li><a href="/products/category=">쿠션 </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav_1deps_item">
                    <a href="/community">COMMUNITY</a>
                    <ul class="lnb">
                        <li><a href="/community/notice">공지사항</a></li>
                        <li><a href="/community/reference">자료실</a></li>
                        <li><a href="/community/inquiry">1:1 문의</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</header>