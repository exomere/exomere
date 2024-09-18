@extends('pages.layouts.visualFullWidthLayout')

@section('title', __('gnb.about'))

@section('id', 'about')
@section('visual_title',  __('gnb.about') )
@section('visual_sub_title', __('gnb.about_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
    <style>
        #parallax__nav li a {
            transition: all 0.3s ease-in-out;
        }

        #parallax__nav li a.active {
            color: rgb(207 87 51);
            font-weight: 600;
        }
    </style>
@endsection
@section('content')

    <div class="relative">
        <nav id="parallax__nav" class="relative bg-white w-full left-0 z-40
         lg:absolute lg:top-20 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-sm text-center text-slate-500 lg:flex-col lg:text-base">
                <li class="relative p-3 basis-1/3"><a
                        class="active" href="#philosophy">Philosophy</a>
                </li>
                <li class="relative p-3 basis-1/3"><a
                        href="#exosome">Exosome</a>
                </li>
                <li class="relative p-3 basis-1/3"><a
                        href="#telomere">Telomere</a>
                </li>
            </ul>
        </nav>


        <div id="parallax__cont" class="overflow-hidden
bg-[url('https://images.unsplash.com/photo-1583339824000-5afecfd41835?q=80&w=2487&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')]
bg-cover bg-center
{{--        bg-gradient-to-r from-[#e8e8e8]--}}
         text-[#211914]">

            <section id="philosophy" class="pb-32 lg:pb-40">
                <div class="pt-20 px-4 lg:pl-44">
                    <div class="relative z-30 text-left tracking-tight">
                        <h2 class="text-3xl text-head font-semibold leading-tight mb-3 md:text-4xl"
                            data-aos="fade">엑소좀 안티에이징 솔루션,<br>엑소미어</h2>
                        <p class="max-w-sm text-sm leading-loose break-keep my-5
                    md:max-w-2xl md:text-xl md:leading-loose"
                           data-aos="fade"
                           data-aos-delay="100">
                            {{ __('messages.about_content_head_1') }}{{ __('messages.about_content_1') }}<br>
                            {{ __('messages.about_content_head_2') }}{{ __('messages.about_content_2') }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-y-1 lg:flex-row lg:gap-x-1">
                        <picture class="lg:basis-2/5 overflow-hidden">
                            <source srcset="{{ asset('assets/img/elements/subvisual_product.jpg') }}">
                            <img src="{{ asset('assets/img/elements/subvisual_product.jpg') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="mix">
                        </picture>
                        <picture class="lg:basis-3/5 overflow-hidden">
                            <source srcset="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}">
                            <img src="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="mix">
                        </picture>
                    </div>
                </div>
                <div
                    class="text-3xl text-head text-center font-semibold leading-tight pt-10
                    md:text-3xl lg:pt-40"
                    data-aos="fade"
                    data-aos-delay="300"
                    data-aos-duration="1000">
                    엑소좀 + 텔로미어 = 엑소미어
                </div>
            </section>


            <div id="swipe__section">
                <section id="exosome"
                         class="parallax__scroll bg-white static w-full min-h-screen relative flex flex-col  justify-center">

                    <div class="flex flex-col lg:flex-row">
                        <div class="h-svh w-full overflow-hidden lg:basis-1/2">
                            <picture>
                                <source srcset="{{ asset('assets/img/elements/about_01.png') }}">
                                <img src="{{ asset('assets/img/elements/about_01.png') }}"
                                     alt=""
                                     class="w-full h-full"
                                     data-aos="mix"
                                     data-aos-duration="1000"
                                >
                            </picture>
                        </div>

                        <div
                            class="relative z-30 text-left tracking-tight py-7 px-4 lg:basis-1/2 lg:flex lg:flex-col lg:justify-center lg:pb-40 lg:pr-44">
                            <p class="text-4xl font-semibold text-[rgba(79,53,40,0.1)] md:text-[5rem] lg:mb-7">01</p>
                            <h2 class="text-3xl text-head font-semibold leading-tight mb-3 whitespace-pre-line  md:text-4xl"
                                data-aos="fade">엑소좀 EXO-complex</h2>
                            <p class="max-w-sm text-sm leading-loose break-keep my-5 md:max-w-2xl md:text-xl md:leading-loose"
                               data-aos="fade"
                               data-aos-delay="100">{{ __('messages.about_content_head_3') }}{{ __('messages.about_content_3') }}</p>
                        </div>
                    </div>
                </section>
                {{--                telomere--}}
                <section id="telomere"
                         class="parallax__scroll bg-white static w-full min-h-screen relative flex flex-col  justify-center">

                    <div class="flex flex-col lg:flex-row">
                        <div class="h-svh w-full overflow-hidden lg:basis-1/2 lg:order-last">
                            <picture>
                                <source srcset="{{ asset('assets/img/elements/about_technology_2.webp') }}">
                                <img src="{{ asset('assets/img/elements/about_technology_2.webp') }}"
                                     alt=""
                                     class="w-full h-full"
                                     data-aos="mix"
                                     data-aos-duration="1000"
                                >
                            </picture>
                        </div>

                        <div
                            class="relative z-30 text-left tracking-tight py-7 px-4 lg:basis-1/2 lg:flex lg:flex-col lg:justify-center lg:pb-40 lg:pl-44">
                            <p class="text-4xl font-semibold text-[rgba(79,53,40,0.1)] md:text-[5rem] lg:mb-7">02</p>
                            <h2 class="text-3xl text-head font-semibold leading-tight mb-3 whitespace-pre-line  md:text-4xl"
                                data-aos="fade">텔로미어 Telomere</h2>
                            <p class="max-w-sm text-sm leading-loose break-keep my-5 md:max-w-2xl md:text-xl md:leading-loose"
                               data-aos="fade"
                               data-aos-delay="100">{{ __('messages.about_content_head_4') }}{{ __('messages.about_content_4') }}</p>
                        </div>
                    </div>
                </section>
                <section id="last__section"
                         class="parallax__scroll h-screen">
                    <div
                        class="w-full h-full flex flex-col justify-center bg-cover bg-center bg-[url('{{ asset('assets/img/elements/subvisual_product.jpg') }}')]">
                        <div class="relative z-30 text-left tracking-tight py-7 px-4 text-white lg:text-center">
                            <h2 class="text-3xl font-semibold leading-tight mb-3 whitespace-pre-line md:text-4xl"
                                data-aos="fade">Only One
                                and Everything</h2>
                            <p class="max-w-sm text-lg font-normal leading-loose break-words my-5 md:max-w-2xl md:text-xl md:leading-loose lg:max-w-full "
                               data-aos="fade"
                               data-aos-delay="100">엑소미어와 함께,<br class="lg:hidden">
                                피부의 본래 아름다움과 활력을 되찾아 보세요.</p>
                        </div>
                    </div>
                </section>

                <section class="max-lg:hidden parallax__scroll h-screen"></section>
            </div>


        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('assets/vendor/libs/gasp/gsap.min.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/gasp/ScrollTrigger.min.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/gasp/ScrollToPlugin.min.js') }}"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);
        gsap.registerPlugin(ScrollToPlugin);

        //nav
        let links = gsap.utils.toArray("#parallax__nav ul li a");

        links.forEach(link => {
            let element = document.querySelector(link.getAttribute("href"));
            let linkST = ScrollTrigger.create({
                trigger: element,
                start: "top top"
            });

            ScrollTrigger.create({
                trigger: element,
                start: "top center",
                end: "bottom center",
                onToggle: self => setActive(link)
            });

            link.addEventListener("click", e => {
                e.preventDefault();
                gsap.to(window, {duration: .3, scrollTo: linkST.start - document.querySelector("header").offsetHeight, overwrite: "auto"});
            })
        });

        function setActive(link) {
            links.forEach(el => el.classList.remove("active"));
            link.classList.add("active");
        }

        // 스냅 고정 효과 만들기
        ScrollTrigger.matchMedia({
            "(min-width: 1024px)": function () {

                let swipePanels = gsap.utils.toArray(".parallax__scroll");

                swipePanels.forEach((panel, i) => {
                    ScrollTrigger.create({
                        trigger: panel,
                        start: () => panel.offsetHeight < window.innerHeight ? "top top" : "bottom bottom",
                        pin: true,
                        pinSpacing: false
                    });
                });
            },
        });
        window.addEventListener("resize", ScrollTrigger.update);


        //fixed nav
        var header = document.querySelector("header");
        var nav = document.getElementById("parallax__nav");
        var headerHeight = header.offsetHeight;
        var navOffset = nav.getBoundingClientRect().top - headerHeight + nav.offsetHeight;
        var prefix = matchMedia("screen and (min-width: 1024px)").matches ? 'lg:' : '';

        $(window).scroll(function () {
            if (window.pageYOffset >= navOffset) {
                nav.classList.remove(prefix + "absolute");
                nav.classList.add(prefix + "fixed", prefix + "top-[" + headerHeight + "px]",);
                nav.classList.remove("relative");
            } else {
                nav.classList.add(prefix + "absolute");
                nav.classList.remove(prefix + "fixed", prefix + "top-[" + headerHeight + "px]",);
                nav.classList.add("relative");
            }
        });

    </script>
@endsection

