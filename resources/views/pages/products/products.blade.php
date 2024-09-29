@extends('pages.layouts.subLayout')
@section('title', __('gnb.products'))

@section('id', 'products')
@section('visual_title',  __('gnb.products') )
@section('visual_sub_title', '')
@section('visual_background', asset("assets/img/elements/subvisual_product.jpg"))

@section('page-style')

@endsection
@section('content')
    <!-- tabs -->
    <ul class="flex flex-wrap justify-center items-center padding-y -mb-px text-base lg:text-lg font-medium text-center tracking-tight"
        id="tab"
        role="tablist"
        data-tabs-active-classes="text-exomere"
        data-tabs-inactive-classes="false"
        data-tabs-toggle="#tab-content"
    >
        @foreach($categories as $category)
            <li role="presentation"
                class="relative px-4
                                @if(!$loop->last)
                                    after:absolute after:top-1/2 after:right-0 after:w-[1px] after:h-[12px] after:mt-[-6px] after:bg-[#e9e9e9]
                                @endif
                                ">
                <button class="inline-block "
                        id="{{$category}}-tab"
                        type="button"
                        role="tab"
                        data-tabs-target="#{{$category}}"
                        aria-controls="{{$category}}"
                        aria-selected="{{ (!$selectedCategory && $category=='view_all') ||  ($category == $selectedCategory) ? 'true' : 'false'}}"
                >{{ __('gnb.'.$category) }}
                </button>
            </li>
        @endforeach
    </ul>

    <!-- tab contents -->
    <div id="tab-content">
        @foreach($items as $category => $data)
            <div class="hidden"
                 id="{{$category}}"
                 role="tabpanel"
                 aria-labelledby="{{$category}}-tab"
                 data-aos="fade-right">
                @if(count($data))
                    <div
                        class="mt-6 grid grid-cols-2 gap-x-4 gap-y-6 lg:grid-cols-3 lg:gap-x-6 lg:gap-y-10">
                        @foreach($data as $item)
                            <div class="group relative mx-auto">
                                <div
                                    class="relative w-full aspect-square bg-cover bg-center group-hover:bg-[url({{$item['thumbnail2']}})]">
                                    <img src="{{$item['thumbnail']}}" alt="{{$item['product_name']}}"
                                         class="h-full w-full object-center lg:h-full lg:w-full group-hover:opacity-0 transition-opacity duration-500">
                                </div>
                                <div class="mt-4 text-left">
                                    <h3 class="mb-5 text-lg text-gray-900">
                                        <a href="/products/{{ $item['id'] }}">
                                                            <span aria-hidden="true"
                                                                  class="absolute inset-0"></span>
                                            {{$item['product_name']}}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600">{{number_format($item['price'])}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="p-10 text-center text-xl text-gray-600 font-normal">
                        등록된 상품이 없습니다
                    </div>
                @endif

            </div>
        @endforeach
    </div>
@endsection

@section('page-script')
    <script>
        const tab = document.querySelector('#tab');
        tab.querySelectorAll('[role="tab"]').forEach(function (elem) {
            elem.addEventListener('click', (event) => {
                if (event.target.ariaSelected !== 'true') {
                    event.preventDefault();
                    document.querySelector(event.target.dataset.tabsTarget).classList.remove('aos-animate');
                }
            })
        })
    </script>
@endsection

