<header id="header" data-type="header" class="">
    <div class="layout_inner"><a href="/" class="logo">EXOMERE</a>@include('pages.partials.gnb')
        <div class="utility"><!-- 언어 설정 -->
            <div class="language">
                <button class="btn_open">한국/한국어</button>
                <div class="box"><strong class="title">Language</strong>
                    <ul id="language_list">
                        <li class="active"><a href="/kr/ko/index.html" lang="ko">한국/한국어</a></li>
                        <li><a href="https://www.ap-beauty.com/int/en/index.html" target="_blank" lang="en">INTERNATIONAL/ENGLISH</a>
                        </li>
                        <li><a href="http://www.ap-beauty.com.cn" target="_blank" lang="zh">中文</a></li>
                        <li><a href="https://hk.ap-beauty.com/" target="_blank" lang="zh">繁體中文</a></li>
                    </ul>
                    <button class="language_close">close</button>
                </div>
            </div><!-- 기타 메뉴 -->
            <a href="javascript:void(0)" class="btn_search">TOTAL SEARCH</a></div>
    </div><!-- 검색 -->
    <div class="search_wrap" style="top: 156px;">
        <section class="search_inner">
            <div class="search_box"><!-- 23.02.08 태그변경 --><strong class="title">search</strong>
                <div class="input"><label><input type="search" id="global-search" placeholder="Enter a search term"
                                                 onkeypress="SEARCH.enterGlobalSearch(event)" maxlength="500"></label>
                    <button class="search_del" id="global_search_del">del</button>
                </div>
                <button onclick="SEARCH.insertQuery('global-search')">SEARCH</button><!-- 자동완성 최대 10개 -->
                <div class="autocomplete" style="display:none;"></div>
            </div>
        </section>
        <button class="btn_close"><span>CLOSED</span></button>
    </div><!-- // 검색 -->
</header>
