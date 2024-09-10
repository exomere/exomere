@extends('pages.layouts.visualFullWidthLayout')

@section('title', __('gnb.about'))

@section('id', 'about')
@section('visual_title',  __('gnb.about') )
@section('visual_sub_title', __('gnb.about_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
    <style>
        {{--        물 --}}
                          /*https://cdn.pixabay.com/photo/2021/10/12/17/41/abstract-6704211_1280.jpg*/
        /*배경*/
        .philosophy {
            background-image: url("{{ asset('assets/img/elements/bedge-grunge-1920x1080.png') }}");
        }

        .gray {
            background-image: radial-gradient(circle, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
            radial-gradient(circle, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .blue {
            background-color: #2c7ad2;
            background-image: radial-gradient(circle at 47% 14%, rgba(205, 205, 205, 0.04) 0%, rgba(205, 205, 205, 0.04) 43%, transparent 43%, transparent 100%), radial-gradient(circle at 35% 12%, rgba(215, 215, 215, 0.04) 0%, rgba(215, 215, 215, 0.04) 4%, transparent 4%, transparent 100%), radial-gradient(circle at 1% 35%, rgba(24, 24, 24, 0.04) 0%, rgba(24, 24, 24, 0.04) 37%, transparent 37%, transparent 100%), radial-gradient(circle at 21% 1%, rgba(0, 0, 0, 0.04) 0%, rgba(0, 0, 0, 0.04) 26%, transparent 26%, transparent 100%), radial-gradient(circle at 23% 82%, rgba(249, 249, 249, 0.04) 0%, rgba(249, 249, 249, 0.04) 60%, transparent 60%, transparent 100%), radial-gradient(circle at 11% 54%, rgba(251, 251, 251, 0.04) 0%, rgba(251, 251, 251, 0.04) 23%, transparent 23%, transparent 100%), radial-gradient(circle at 69% 68%, rgba(234, 234, 234, 0.04) 0%, rgba(234, 234, 234, 0.04) 10%, transparent 10%, transparent 100%), linear-gradient(90deg, #2c7ad2, #1568c6);
        }

        .orange {
            background-color: #e77614;
            background-image: radial-gradient(circle at 46% 40%, rgba(228, 228, 228, 0.06) 0%, rgba(228, 228, 228, 0.06) 13%, transparent 13%, transparent 100%), radial-gradient(circle at 11% 41%, rgba(198, 198, 198, 0.06) 0%, rgba(198, 198, 198, 0.06) 19%, transparent 19%, transparent 100%), radial-gradient(circle at 52% 23%, rgba(14, 14, 14, 0.06) 0%, rgba(14, 14, 14, 0.06) 69%, transparent 69%, transparent 100%), radial-gradient(circle at 13% 85%, rgba(148, 148, 148, 0.06) 0%, rgba(148, 148, 148, 0.06) 44%, transparent 44%, transparent 100%), radial-gradient(circle at 57% 74%, rgba(232, 232, 232, 0.06) 0%, rgba(232, 232, 232, 0.06) 21%, transparent 21%, transparent 100%), radial-gradient(circle at 59% 54%, rgba(39, 39, 39, 0.06) 0%, rgba(39, 39, 39, 0.06) 49%, transparent 49%, transparent 100%), radial-gradient(circle at 98% 38%, rgba(157, 157, 157, 0.06) 0%, rgba(157, 157, 157, 0.06) 24%, transparent 24%, transparent 100%), radial-gradient(circle at 8% 6%, rgba(60, 60, 60, 0.06) 0%, rgba(60, 60, 60, 0.06) 12%, transparent 12%, transparent 100%), linear-gradient(90deg, #ff7600, #ff7600);
        }

        .red {
            background-color: #c82736;
            background-image: radial-gradient(circle at 19% 90%, rgba(190, 190, 190, 0.04) 0%, rgba(190, 190, 190, 0.04) 17%, transparent 17%, transparent 100%), radial-gradient(circle at 73% 2%, rgba(78, 78, 78, 0.04) 0%, rgba(78, 78, 78, 0.04) 94%, transparent 94%, transparent 100%), radial-gradient(circle at 45% 2%, rgba(18, 18, 18, 0.04) 0%, rgba(18, 18, 18, 0.04) 55%, transparent 55%, transparent 100%), radial-gradient(circle at 76% 60%, rgba(110, 110, 110, 0.04) 0%, rgba(110, 110, 110, 0.04) 34%, transparent 34%, transparent 100%), radial-gradient(circle at 68% 56%, rgba(246, 246, 246, 0.04) 0%, rgba(246, 246, 246, 0.04) 16%, transparent 16%, transparent 100%), radial-gradient(circle at 71% 42%, rgba(156, 156, 156, 0.04) 0%, rgba(156, 156, 156, 0.04) 47%, transparent 47%, transparent 100%), radial-gradient(circle at 46% 82%, rgba(247, 247, 247, 0.04) 0%, rgba(247, 247, 247, 0.04) 39%, transparent 39%, transparent 100%), radial-gradient(circle at 50% 47%, rgba(209, 209, 209, 0.04) 0%, rgba(209, 209, 209, 0.04) 45%, transparent 45%, transparent 100%), linear-gradient(90deg, #e53949, #cc2232);
        }

        .purple {
            background-color: #8d3dae;
            background-image: radial-gradient(circle at 47% 14%, rgba(205, 205, 205, 0.04) 0%, rgba(205, 205, 205, 0.04) 43%, transparent 43%, transparent 100%), radial-gradient(circle at 35% 12%, rgba(215, 215, 215, 0.04) 0%, rgba(215, 215, 215, 0.04) 4%, transparent 4%, transparent 100%), radial-gradient(circle at 1% 35%, rgba(24, 24, 24, 0.04) 0%, rgba(24, 24, 24, 0.04) 37%, transparent 37%, transparent 100%), radial-gradient(circle at 21% 1%, rgba(0, 0, 0, 0.04) 0%, rgba(0, 0, 0, 0.04) 26%, transparent 26%, transparent 100%), radial-gradient(circle at 23% 82%, rgba(249, 249, 249, 0.04) 0%, rgba(249, 249, 249, 0.04) 60%, transparent 60%, transparent 100%), radial-gradient(circle at 11% 54%, rgba(251, 251, 251, 0.04) 0%, rgba(251, 251, 251, 0.04) 23%, transparent 23%, transparent 100%), radial-gradient(circle at 69% 68%, rgba(234, 234, 234, 0.04) 0%, rgba(234, 234, 234, 0.04) 10%, transparent 10%, transparent 100%), linear-gradient(90deg, #8d3dae, #8d3dae);
        }

        .green {
            background-color: #28a92b;
            background-image: radial-gradient(circle at 46% 40%, rgba(228, 228, 228, 0.06) 0%, rgba(228, 228, 228, 0.06) 13%, transparent 13%, transparent 100%), radial-gradient(circle at 11% 41%, rgba(198, 198, 198, 0.06) 0%, rgba(198, 198, 198, 0.06) 19%, transparent 19%, transparent 100%), radial-gradient(circle at 52% 23%, rgba(14, 14, 14, 0.06) 0%, rgba(14, 14, 14, 0.06) 69%, transparent 69%, transparent 100%), radial-gradient(circle at 13% 85%, rgba(148, 148, 148, 0.06) 0%, rgba(148, 148, 148, 0.06) 44%, transparent 44%, transparent 100%), radial-gradient(circle at 57% 74%, rgba(232, 232, 232, 0.06) 0%, rgba(232, 232, 232, 0.06) 21%, transparent 21%, transparent 100%), radial-gradient(circle at 59% 54%, rgba(39, 39, 39, 0.06) 0%, rgba(39, 39, 39, 0.06) 49%, transparent 49%, transparent 100%), radial-gradient(circle at 98% 38%, rgba(157, 157, 157, 0.06) 0%, rgba(157, 157, 157, 0.06) 24%, transparent 24%, transparent 100%), radial-gradient(circle at 8% 6%, rgba(60, 60, 60, 0.06) 0%, rgba(60, 60, 60, 0.06) 12%, transparent 12%, transparent 100%), linear-gradient(90deg, #28a92b, #10a614);
        }


        #parallax__nav li a.active {
            color: #1d335c;
            font-weight: 600;
        }

        #parallax__nav li:has(a.active) {
            border-color: #1d335c;
        }

        @media (max-width: 1024px) {
            #parallax__nav li:has(a.active)::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 1px;
                background-color: black;
                z-index: 1;
            }
        }

        @media (min-width: 1024px) {
            #parallax__nav li:has(a.active) {

            }
        }

        /* parallax__cont */
        #parallax__cont {
            overflow: hidden;
        }

        .parallax__item {
            width: 100%;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #section2,
        #section4,
        #section6,
        #section8 {
            background-color: #222;
        }

        .parallax__item__num {
            position: absolute;
            right: 20px;
            bottom: 20px;
            font-size: 3vw;
            line-height: 1;
            z-index: 10;
        }

        .parallax__item__img {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            /*background-color: #fff;*/
            background-size: cover;
            background-position: center;
        }

        .parallax__item__img::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
        }

        .parallax__item__title {
            /*font-size: 5vw;*/
            /*z-index: 30;*/
            /*text-transform: uppercase;*/
            /*display: inline-block;*/
        }

        #philosophy .parallax__item__img {
        {{--            background-image: url("{{asset('assets/img/elements/about_technology_2.webp')}}");--}}








        }

        #section2 .parallax__item__img {
            background-image: url("{{asset('assets/img/elements/about_01.png')}}");
        }

        #section3 .parallax__item__img {
            background-image: url("https://cdn.pixabay.com/photo/2024/06/19/19/53/oil-8840679_1280.jpg");
        }

        #section4 .parallax__item__img {
            background-image: url("{{asset('https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg')}}");
        }

        #section5 .parallax__item__img {
            background-image: url("{{asset('assets/img/elements/about_technology_2.webp')}}");
        }

        #section6 .parallax__item__img {
            background-image: url("{{asset('assets/img/elements/about_01.png')}}");
        }

        #section7 .parallax__item__img {
            background-image: url("https://cdn.pixabay.com/photo/2024/06/19/19/53/oil-8840679_1280.jpg");
        }

        #section8 .parallax__item__img {
            background-image: url("{{asset('https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg')}}");
        }

        #section9 .parallax__item__img {
            background-image: url("{{asset('assets/img/elements/about_technology_2.webp')}}");
        }

        #exosome .parallax__item__img {
        {{--background-image: url("{{asset('assets/img/elements/about_01.png')}}");--}}






        }

        #telomere .parallax__item__img {
        {{--background-image: url("{{asset('assets/img/elements/about_technology_2.webp')}}");--}}






        }

        . {
            /*display: none;*/
            /*font-size: 4vw;*/
            /*line-height: 1.4;*/
            /*margin-top: -5vw;*/
            /*margin-left: -4vw;*/
            /*z-index: 100;*/
            /*position: relative;*/
        }

        .parallax__item:nth-child(even) . {
            /*margin-left: auto;*/
            /*margin-right: -4vw;*/
        }


    </style>
@endsection
@section('content')

    <div class="relative">
        <nav id="parallax__nav" class="relative bg-white w-full left-0 z-40
        lg:absolute lg:pt-20 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-center text-slate-500
            lg:flex-col lg:gap-y-2
            ">
                <li class="relative p-4 basis-1/2 lg:rounded-full lg:border border-solid border-slate-300"><a
                        class="active" href="#philosophy">Philosophy</a></li>
                <li class="relative p-4 basis-1/2 lg:rounded-full lg:border border-solid border-slate-300"><a
                        href="#exosome">Exosome</a>
                </li>
                <li class="relative p-4 basis-1/2 lg:rounded-full lg:border border-solid border-slate-300"><a
                        href="#telomere">Telomere</a>
                </li>
            </ul>
        </nav>


        <div id="parallax__cont" class="bg-gradient-to-r from-[#e8e8e8] text-[#211914]">

            <section id="philosophy" class="pb-32 lg:pb-40">
                <div class="pt-20 px-4 lg:pl-44">
                    <figure class="parallax__item__imgWrap">
                        <div class="parallax__item__img"></div>
                    </figure>
                    <div class="relative z-30 text-left tracking-tight">
                        <h2 class="text-3xl text-[#1d335c] font-semibold leading-tight mb-3 md:text-4xl"
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
                                 data-aos="scale">
                        </picture>
                        <picture class="lg:basis-3/5 overflow-hidden">
                            <source srcset="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}">
                            <img src="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="scale">
                        </picture>
                    </div>
                </div>
                <div
                    class="text-3xl text-[#1d335c] text-center font-semibold leading-tight pt-10
                    md:text-2xl lg:pt-40"
                    data-aos="fade-up">
                    엑소좀 + 텔로미어 = 엑소미어
                </div>
            </section>


            <section id="exosome"
                     class="parallax__scroll bg-white static w-full min-h-screen relative flex flex-col  justify-center">

                <div class="flex flex-col lg:flex-row">
                    <div class="h-svh w-full lg:basis-1/2">
                        <picture>
                            <source srcset="{{ asset('assets/img/elements/about_01.png') }}">
                            <img src="{{ asset('assets/img/elements/about_01.png') }}"
                                 alt=""
                                 class="w-full h-full">
                        </picture>
                    </div>

                    <div
                        class="relative z-30 text-left tracking-tight py-7 px-4 lg:basis-1/2 lg:flex lg:flex-col lg:justify-center lg:pb-40">
                        <p class="text-4xl font-semibold text-[rgba(79,53,40,0.1)] md:text-[5rem] lg:mb-3">01</p>
                        <h2 class="text-3xl text-[#1d335c] font-semibold leading-tight mb-3 whitespace-pre-line  md:text-4xl"
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
                    <div class="h-svh w-full lg:basis-1/2">
                        <picture>
                            <source srcset="{{ asset('assets/img/elements/about_01.png') }}">
                            <img src="{{ asset('assets/img/elements/about_01.png') }}"
                                 alt=""
                                 class="w-full h-full">
                        </picture>
                    </div>

                    <div
                        class="relative z-30 text-left tracking-tight py-7 px-4 lg:basis-1/2 lg:flex lg:flex-col lg:justify-center lg:pb-40">
                        <p class="text-4xl font-semibold text-[rgba(79,53,40,0.1)] md:text-[5rem] lg:mb-3">02</p>
                        <h2 class="text-3xl text-[#1d335c] font-semibold leading-tight mb-3 whitespace-pre-line  md:text-4xl"
                            data-aos="fade">텔로미어 Telomere</h2>
                        <p class="max-w-sm text-sm leading-loose break-keep my-5 md:max-w-2xl md:text-xl md:leading-loose"
                           data-aos="fade"
                           data-aos-delay="100">{{ __('messages.about_content_head_4') }}{{ __('messages.about_content_4') }}</p>
                    </div>
                </div>
            </section>

            <section id="last__section" class="parallax__scroll h-screen bg-cover bg-center bg-[url('{{ asset('assets/img/elements/subvisual_product.jpg') }}')]
            flex flex-col justify-center">
                <div class="relative z-30 text-left tracking-tight py-7 px-4 text-white lg:text-center">
                    <h2 class="text-3xl font-semibold leading-tight mb-3 whitespace-pre-line md:text-4xl"
                        data-aos="fade">Only One
                        and Everything</h2>
                    <p class="max-w-sm text-lg font-normal leading-loose break-words my-5 md:max-w-2xl md:text-xl md:leading-loose lg:max-w-full "
                       data-aos="fade"
                       data-aos-delay="100">엑소미어와 함께,<br class="lg:hidden">
                        피부의 본래 아름다움과 활력을 되찾아 보세요.</p>
                </div>
            </section>

            <section class="max-lg:hidden parallax__scroll h-[305px]"></section>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{asset('assets/vendor/libs/gasp/gsap.min.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/gasp/ScrollTrigger.min.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/gasp/ScrollToPlugin.min.js') }}"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

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
                gsap.to(window, {duration: .3, scrollTo: linkST.start, overwrite: "auto"});
            })
        });

        function setActive(link) {
            links.forEach(el => el.classList.remove("active"));
            link.classList.add("active");
        }

        // 03. 스냅 고정 효과 만들기
        ScrollTrigger.matchMedia({
            "(min-width: 1024px)": function () {

                let panels = gsap.utils.toArray(".parallax__scroll");
                let tops = panels.map(panel => ScrollTrigger.create({trigger: panel, start: "top top"}));

                panels.forEach((panel, i) => {
                    ScrollTrigger.create({
                        trigger: panel,
                        start: () => panel.offsetHeight < window.innerHeight ? "top top" : "bottom bottom",
                        pin: true,
                        pinSpacing: false
                    });
                });

                // // footer
                let footer = document.querySelector("footer"),
                    getOverlap = () => Math.min(window.innerHeight, footer.offsetHeight), // we never want it to overlap more than the height of the screen
                    adjustFooterOverlap = () => footer.style.marginTop = -getOverlap() + "px"; // adjusts the margin-top of the footer to overlap the proper amount

                adjustFooterOverlap();

                // to make it responsive, re-calculate the margin-top on the footer when the ScrollTriggers revert
                ScrollTrigger.addEventListener("revert", adjustFooterOverlap);

                // magic
                ScrollTrigger.create({
                    trigger: footer,
                    start: () => "top " + (window.innerHeight - getOverlap()),
                    end: () => "+=" + getOverlap(),
                    pin: true,
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

