<header id="header" data-type="header" class="">
    <div class="layout_inner">
        <a href="/" class="logo">EXOMERE</a>
        @include('pages.partials.gnb')
        <div class="utility">
            <!-- 언어 설정 -->
            <div class="language">
                <button class="btn_open">
                    @switch(app()->getLocale())
                        @case('ko')
                            한국어
                            @break
                        @case('en')
                            English
                            @break
                        @case('jp')
                            日本語
                            @break
                        @case('cn')
                            中文
                            @break
                        @default
                            {{ strtoupper(app()->getLocale()) }}
                    @endswitch
                </button>
                <div class="box">
                    <strong class="title">Language</strong>
                    <ul id="language_list">
                        <li class="{{ app()->getLocale() == 'ko' ? 'active' : '' }}">
                            <a href="{{ route('setLanguage', ['lang' => 'ko']) }}" lang="ko">한국어</a>
                        </li>
                        <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
                            <a href="{{ route('setLanguage', ['lang' => 'en']) }}" lang="en">ENGLISH</a>
                        </li>
                        <li class="{{ app()->getLocale() == 'jp' ? 'active' : '' }}">
                            <a href="{{ route('setLanguage', ['lang' => 'jp']) }}" lang="zh">日本語です</a>
                        </li>
                        <li class="{{ app()->getLocale() == 'cn' ? 'active' : '' }}">
                            <a href="{{ route('setLanguage', ['lang' => 'cn']) }}" lang="zh">中文</a>
                        </li>
                    </ul>
                    <button class="language_close">close</button>
                </div>
            </div>
            <!-- 기타 메뉴 -->
            <a href="javascript:void(0)" class="btn_search">TOTAL SEARCH</a>
        </div>
    </div>
    <!-- 검색 -->
    <div class="search_wrap" style="top: 156px;">
        <section class="search_inner">
            <div class="search_box">
                <strong class="title">search</strong>
                <div class="input">
                    <label>
                        <input type="search" id="global-search" placeholder="Enter a search term"
                               onkeypress="SEARCH.enterGlobalSearch(event)" maxlength="500">
                    </label>
                    <button class="search_del" id="global_search_del">del</button>
                </div>
                <button onclick="SEARCH.insertQuery('global-search')">SEARCH</button>
                <div class="autocomplete" style="display:none;"></div>
            </div>
        </section>
        <button class="btn_close"><span>CLOSED</span></button>
    </div>
    <!-- // 검색 -->
</header>