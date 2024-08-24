<header id="header" class="fixed inset-x-0 z-50 bg-transparent" aria-label="Global">
    <div class="header_wrap">
        <div class="gnb relative flex flex-wrap items-center justify-between p-3 lg:px-16 lg:py-6">
            <div class="flex gap-x-2 items-center">
                {{--mobile hamberger--}}
                <div class="flex lg:hidden">
                    <button type="button"
                            id="toggle-mobile-menu"
                            class="inline-flex"
                            data-collapse-toggle="mobile-menu"
                            aria-expanded="false">
                        <span class="sr-only">Toggle main menu</span>
                        <svg class="open__btn w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <svg class="close__btn hidden w-8 h-8 z-[101] text-white" fill="none" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>


                {{--language--}}
                <div class="language__select relative text-xs">
                    <button class="language__button inline-flex items-center"
                            data-collapse-toggle="language__list"
                            aria-expanded="false"
                    >
                        {{ config('meta.languages.'.app()->getLocale())  ?? strtoupper(app()->getLocale())  }}

                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                             class="bi bi-chevron-down"
                             viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>

                    </button>
                    <ul id="language__list" class="hidden absolute">
                        @foreach(array_keys(config('meta.languages')) as $lang)
                            @continue( app()->getLocale() == $lang )
                            <li>
                                <a class="underline-animation"
                                   href="{{ route('setLanguage', ['lang' => $lang]) }}"
                                   lang="{{ $lang }}">{{ config('meta.languages.'.$lang) }}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <!--logo-->
            <a href="/" class="w-32 lg:w-44">
                <span class="sr-only">엑소미어</span>
                <img class="" src="//exomere.co.kr/common/image/logo/logo_horizontal.svg" alt="">
            </a>

            {{--login/search--}}
            <div class="flex gap-x-2 items-center justify-center">
                <a href="/login" target="_blank" class="myoffice__button flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="25" height="25"
                         class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path
                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <span class="hidden lg:block">My Office</span>
                </a>

                <button type="button" class="gnb__search__button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>

                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>

        <!-- web menu, show/hide based on screen width -->
        <div class="__nav max-lg:hidden" >
            <ul class="flex flex-wrap gap-x-5 justify-center items-start text-left py-3">
                @foreach ($gnbData[0]->menu as $item)
                    <li class="min-w-[100px]">
                        <a href="javascript:void(0)" class="text-lg font-normal">{{ $item->name }}</a>
                        @if (isset($item->submenu) && count($item->submenu) > 0)
                            <ul class="__lnb hidden pt-2 leading-loose text-base">
                                @foreach ($item->submenu as $subItem)
                                    <li>
                                        <a href="{{ $subItem->url }}" class="font-normal">{{ __('gnb.'.$subItem->name) }}</a>
                                        @if (isset($subItem->submenu) && count($subItem->submenu) > 0)
                                            <ul class="mb-2">
                                                @foreach ($subItem->submenu as $subSubItem)
                                                    <li><a class="underline-animation"
                                                           href="{{ $subSubItem->url }}">{{ __('gnb.'.$subSubItem->name ) }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="hidden" id="mobile-menu">
            <div class="fixed inset-0 z-[100] overflow-y-auto text-white bg-[rgba(207,87,51,0.9)] cursor-default">
                <div id="accordion-nested-parent"
                     class="mt-10 padding divide-y divide-solid divide-[hsla(0,0%,100%,.3)]"
                     data-accordion="collapse"
                     data-active-classes=false
                     data-inactive-classes=false
                >
                    @foreach($gnbData[0]->menu as $menu)

                        <h2 id="accordion-collapse-heading-{{$menu->slug}}"
                            class="text-3xl  leading-loose"
                            data-accordion-target="#accordion-collapse-body-{{$menu->slug}}"
                            aria-controls="accordion-collapse-body-{{$menu->slug}}"
                        >{{$menu->name}}</h2>

                        <div id="accordion-collapse-body-{{$menu->slug}}"
                             class="hidden flex flex-col gap-y-4 py-4 text-xl text-white-800"
                             aria-labelledby="accordion-collapse-heading-{{$menu->slug}}"
                        >
                            @if($menu->submenu)
                                @foreach($menu->submenu as $sub)
                                    @isset($sub->submenu)
                                        <h2 class="font-normal">{{ __('gnb.'.$sub->name ) }}</h2>
                                        @foreach($sub->submenu as $leaf_menu)
                                            <a class="pl-1 text-lg"
                                               href="{{$leaf_menu->url}}"> {{ __('gnb.'.$leaf_menu->name ) }} </a>
                                        @endforeach
                                    @else
                                        <a class="font-normal"
                                           href="{{$sub->url}}"> {{ __('gnb.'.$sub->name ) }} </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>

</header>
