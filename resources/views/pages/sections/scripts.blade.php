<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.tailwindcss.com?plugins=aspect-ratio"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

@yield('vendor-script')

<!-- END: Page Vendor JS-->

<!-- BEGIN: Main JS-->
<script src="{{ asset('assets/js/fo/common.js') }}"></script>
<script src="{{ asset('assets/js/fo/main.js') }}"></script>
<script src="{{ asset('assets/js/fo/tailwind.config.js') }}"></script>
<!-- END: Main JS-->

<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
