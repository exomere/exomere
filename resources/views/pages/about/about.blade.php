@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.about'))
@section('page-style')
    <style>

        .left {
            width: 50%;
        }

        .right {
            height: 100vh;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .desktopContent {
            margin: auto;
            width: 100%;
        }

        .desktopContentSection {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        .desktopPhotos {
            width: 50vw;
            height: 120vw;
            position: relative;
            overflow: hidden;
        }

        .desktopPhoto {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }


        .cont__1 {
            background-image: url("{{asset('assets/img/elements/about_technology_2.webp')}}");
        }

        .cont__2 {
            background-image: url("{{asset('assets/img/elements/about_01.png')}}");
        }

        .cont__3 {
            {{--background-image: url("{{asset('assets/img/elements/about_technology_1.webp')}}");--}}
            background-image: url("https://cdn.pixabay.com/photo/2024/06/19/19/53/oil-8840679_1280.jpg");
        }

        .cont__4 {
{{--            background-image: url("{{asset('assets/img/elements/about_04.png')}}");--}}
            background-image: url("{{asset('https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg')}}");
        }

        /* small screen / mobile layout */
        .mobileContent {
            display: none;
            /*    width: 80vw;*/
        }

        .mobilePhoto {
            width: 80vw;
            height: 80vw;
            margin-top: 5em;
            background-size: cover;
            background-position: center;
        }


        /* defines styles for screens up to 599px wide */
        @media screen and (max-width: 1023px) {
            .left {
                display: none;
            }

            .right {
                height: auto;
                width: 100%;
                align-items: center;
            }

            .desktopPhotos {
                display: none;
            }

            .mobileContent {
                display: block;
            }


        }

        .__bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            {{--background-image: url({{asset('assets/img/elements/about_01.png')}});--}}
              background-size: cover;
            background-position: center;
            z-index: -1; /* Ensure background is behind text */
        }

        .zoom-text, .next-text {
            font-size: 3rem;
            margin: 0;
            position: absolute; /* Position them absolutely for overlapping */
            opacity: 0; /* Hide the next text initially */
            transform-origin: top center; /* Adjust the origin to minimize scroll impact */

        }

        .zoom-text {
            opacity: 1; /* Only the zoom-text is visible initially */
        }

        .__container {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 1;
            transition: opacity 1s ease; /* Smooth transition for background fade */
        }

        .zoom-text, .next-text {
            font-size: 3rem;
            margin: 0;
            position: absolute; /* Position them absolutely for overlapping */
            opacity: 0; /* Hide the next text initially */
            transform-origin: top center; /* Adjust the origin to minimize scroll impact */
        }

        .zoom-text {
            opacity: 1; /* Only the zoom-text is visible initially */
        }
    </style>
@endsection
@section('content')

    <main class="relative" id="about">
        <section class="h-svh">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center"
                 style="background-image: url('{{ asset("assets/img/elements/visual_02.webp") }}')"
            >
                <!-- Subvisual Text -->
                <div class="padding-x text-center font-roboto tracking-tight z-10 text-gray-900">
                    <p class="text-4xl font-medium uppercase" data-aos="fade-down">
                        {{ __('gnb.about') }}
                    </p>
                    <p class="font-medium" data-aos="fade-down" data-aos-delay="200">{{ __('gnb.about_title') }}</p>
                </div>
            </div>
        </section>

        <section class="h-svh">
            <div class="__container">
                <div class="background bg-exomere bg-cover bg-no-repeat bg-fixed"></div>
                <h1 class="zoom-text font-bold text-white">{{ __('messages.about_content_heading_1') }}</h1>
                <h1 class="next-text font-bold text-white">{{ __('messages.about_content_heading_2') }}</h1>
            </div>
        </section>

        <section class="min-h-screen max-md:padding-y">
            <div class="bg-white">
                <div class="mx-auto">
                    <div class="gallery flex">
                        <div class="left">
                            <div class="desktopContent flex flex-col items-center">
                                <div class="desktopContentSection padding max-w-lg ">

                                    <h1 class="text-4xl font-semibold mb-7 text-left" data-aos="fade-up"
                                        data-aos-delay="100">{{ __('messages.about_content_head_1') }}</h1>
                                    <p class="text-2xl leading-loose break-word"
                                       data-aos="fade-in"
                                       data-aos-delay="100">{!! nl2br(__('messages.about_content_1')) !!}</p>
                                </div>
                                <div class="desktopContentSection padding max-w-lg ">

                                    <h1 class="text-4xl font-semibold mb-7 text-left" data-aos="fade-up"
                                        data-aos-delay="100">{{ __('messages.about_content_head_2') }}</h1>
                                    <p class="text-2xl leading-loose break-word"
                                       data-aos="fade-in"
                                       data-aos-delay="100">{!! nl2br(__('messages.about_content_2')) !!}</p>
                                </div>
                                <div class="desktopContentSection padding max-w-lg ">
                                    <h1 class="text-4xl font-semibold mb-7 text-left" data-aos="fade-up"
                                        data-aos-delay="100">{{ __('messages.about_content_head_3') }}</h1>
                                    <p class="text-2xl leading-loose break-word"
                                       data-aos="fade-in"
                                       data-aos-delay="100">{!! nl2br(__('messages.about_content_3')) !!}</p>
                                </div>
                                <div class="desktopContentSection padding max-w-lg ">
                                    <h1 class="text-4xl font-semibold mb-7 text-left" data-aos="fade-up"
                                        data-aos-delay="100">{{ __('messages.about_content_head_4') }}</h1>
                                    <p class="text-2xl leading-loose break-word"
                                       data-aos="fade-in"
                                       data-aos-delay="100">{!! nl2br(__('messages.about_content_4')) !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="right">

                            <!-- mobile content -->
                            <div class="mobileContent max-md:flex max-md:flex-col max-md:gap-y-10">
                                <div class="flex flex-col overflow-hidden">
                                    <div class="h-[80vw] mt-3 bg-cover bg-center cont__1" data-aos="scale"></div>
                                    <div class="padding leading-loose break-word">
                                        <h1 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up"
                                            data-aos-delay="100">{{ __('messages.about_content_head_1') }}</h1>
                                        <p data-aos="fade-in"
                                           data-aos-delay="100">{!! nl2br(__('messages.about_content_1')) !!}</p>
                                    </div>

                                </div>
                                <div class="flex flex-col overflow-hidden">

                                    <div class="h-[80vw] mt-3 bg-cover bg-center  cont__2" data-aos="scale"></div>
                                    <div class="padding leading-loose break-word">

                                        <h1 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up"
                                            data-aos-delay="100">{{ __('messages.about_content_head_2') }}</h1>
                                        <p data-aos="fade-in"
                                           data-aos-delay="100">{!! nl2br(__('messages.about_content_2')) !!}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col overflow-hidden">

                                    <div class="h-[80vw] mt-3 bg-cover bg-center  cont__3" data-aos="scale"></div>
                                    <div class="padding leading-loose break-word">
                                        <h1 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up"
                                            data-aos-delay="100">{{ __('messages.about_content_head_3') }}</h1>
                                        <p data-aos="fade-in"
                                           data-aos-delay="100">{!! nl2br(__('messages.about_content_3')) !!}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <div class="h-[80vw] mt-3 bg-cover bg-center  cont__4" data-aos="scale"></div>
                                    <div class="padding leading-loose break-word">

                                        <h1 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up"
                                            data-aos-delay="100">{{ __('messages.about_content_head_4') }}</h1>
                                        <p data-aos="fade-in"
                                           data-aos-delay="100">{!! nl2br(__('messages.about_content_4')) !!}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- desktop content -->

                            <div class="desktopPhotos">
                                <div class="desktopPhoto cont__1"></div>
                                <div class="desktopPhoto cont__2"></div>
                                <div class="desktopPhoto cont__3"></div>
                                <div class="desktopPhoto cont__4"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="h-[70svh] flex flex-col justify-center padding-x
        bg-[url('{{asset('assets/img/elements/subvisual_bg2.jpg')}}')] bg-cover bg-no-repeat bg-fixed">

            <p class="max-md:text-2xl text-4xl text-white"
               data-aos="fade-in"
               data-aos-duration="1000">{{ __('messages.about_content_footer_1') }}
            </p>
            <p class="max-md:text-2xl text-4xl text-white"
               data-aos="fade-in"
               data-aos-delay="300"
               data-aos-duration="1000">{{ __('messages.about_content_footer_2') }}
            </p>
            <div>
                <a data-aos="fade-in" data-aos-delay="300" href="/products" target="_self"
                   class="mt-12 inline-block border border-solid border-white py-3 px-24 text-white break-keep ">
                    THE MORE
                </a>
            </div>


        </section>

    </main>

@endsection

@section('page-script')
    <script src="//unpkg.co/gsap@3/dist/gsap.min.js"></script>
    <script src="//unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script>
        // learn what all this code means at
        // https://www.creativecodingclub.com/bundles/creative-coding-club
        // unlock over 250 GSAP lessons today


        const details = gsap.utils.toArray(".desktopContentSection:not(:first-child)")
        const photos = gsap.utils.toArray(".desktopPhoto:not(:first-child)")


        gsap.set(photos, {yPercent: 101})

        const allPhotos = gsap.utils.toArray(".desktopPhoto")


        // create
        let mm = gsap.matchMedia();

        // add a media query. When it matches, the associated function will run
        mm.add("(min-width: 1024px)", () => {

            // this setup code only runs when viewport is at least 600px wide
            console.log("desktop")

            ScrollTrigger.create({
                trigger: ".gallery",
                start: "top top",
                end: "bottom bottom",
                pin: ".right"
            })

            details.forEach((detail, index) => {

                let headline = detail.querySelector("h1")
                let animation = gsap.timeline()
                    .to(photos[index], {yPercent: 0})
                    .set(allPhotos[index], {autoAlpha: 0})
                ScrollTrigger.create({
                    trigger: headline,
                    start: "top 80%",
                    end: "top 50%",
                    animation: animation,
                    scrub: true,
                    markers: false
                })
            })


            return () => { // optional
                // custom cleanup code here (runs when it STOPS matching)
                console.log("mobile")
            };
        });

    </script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        gsap.to(".background", {
            yPercent: 20,
            ease: "none",
            scrollTrigger: {
                trigger: ".__container",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".zoom-text",
                start: "top 70%",
                end: "top 50%",
                scrub: true,
                markers: false
            }
        });

        tl.fromTo(".zoom-text",
            {scale: 1},
            {scale: 2, duration: 1}
        )
            .to(".zoom-text",
                {opacity: 0, duration: 0.5}, "-=1"
            )
            .fromTo(".next-text",
                {scale: 1, opacity: 0},
                {scale: 2, opacity: 1, duration: 1},
                "-=0.5"
            );

        // Step 4
        gsap.fromTo(".background",
            {
                {{--backgroundImage: "url('{{asset('assets/img/elements/subvisual_bg2.jpg')}}')",--}}
                backgroundImage: "url('//cdn.pixabay.com/photo/2020/06/13/17/51/milky-way-5295160_1280.jpg')",
                backgroundPosition: "center center",
                opacity: 0,
                filter: "blur(5px)",  // Start with a blur effect
            },
            {
                backgroundPosition: "center center",
                opacity: 1,
                filter: "blur(0px)",   // Remove blur for clarity
                duration: 2.5,         // Slightly longer duration for added smoothness
                ease: "power3.inOut"   // Use an easing function that balances speed and smoothness
            }
        );

    </script>
@endsection

