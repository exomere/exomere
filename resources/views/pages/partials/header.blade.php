<header id="header"
        class="{{ isset($whiteHeader) ? 'text-white fill-white	stroke-white' : '' }} fixed inset-x-0 z-50 bg-transparent"
        aria-label="Global">
    <div class="header_wrap">
        <div class="gnb relative flex flex-wrap items-center justify-between p-3 lg:px-16 lg:pt-6">
            <div class="basis-1/3 flex gap-x-2 items-center">
                {{--mobile hamberger--}}
                <div class="flex lg:hidden">
                    <button type="button"
                            id="toggle-mobile-menu"
                            class="inline-flex "
                            data-collapse-toggle="mobile-menu"
                            aria-expanded="false">
                        <span class="sr-only">Toggle main menu</span>
                        <svg class="open__btn w-8 h-8" viewBox="0 0 24 24" stroke-width="1"
                             fill="currentColor"
                             stroke="currentColor"
                             aria-hidden="true">
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

                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                             class="bi bi-chevron-down"
                             fill="currentColor"
                             stroke="currentColor"
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
            <a href="/" class="basis-1/3 flex justify-center items-center">
                <span class="sr-only">엑소미어</span>
                <img class="log__image m w-32 lg:w-36 lg:hidden" src="{{ asset('img/logo_horizontal.png') }}" alt="">
                <img class="log__image pc max-lg:hidden w-28" src="{{ asset('img/logo.svg') }}" alt="">
            </a>

            {{--login/search--}}
            <div class="basis-1/3 flex gap-x-2 items-center justify-end">
                <a href="/login" target="_blank" class="myoffice__button flex items-center justify-center">
                    <svg  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"  stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="1.2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    <span class="hidden lg:block">My Office</span>
                </a>
                <button>
                    <svg aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         fill="currentColor"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- web menu, show/hide based on screen width -->
        <div class="__nav max-lg:hidden">
            <ul class="flex flex-wrap gap-x-5 justify-center items-start text-center text-left py-3">
                @foreach ($gnbData[0]->menu as $item)
                    <li class="min-w-[100px]">
                        <a href="javascript:void(0)" class="text-base font-normal">{{ $item->name }}</a>
                        @if (isset($item->submenu) && count($item->submenu) > 0)
                            <ul class="__lnb hidden pt-2 leading-loose text-sm">
                                @foreach ($item->submenu as $subItem)
                                    <li>
                                        <a href="{{ $subItem->url }}"
                                           class="underline-animation font-normal">{{ __('gnb.'.$subItem->name) }}</a>
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
