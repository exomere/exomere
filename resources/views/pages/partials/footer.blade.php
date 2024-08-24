<footer id="footer"
        class="w-full bg-exomere font-light text-sm text-white">

    <div class="flex flex-wrap gap-x-3 p-7 lg:p-12">
        <ul class="flex flex-col lg:flex-1 lg:inline-flex lg:gap-y-3">
            <li><strong>{{ __('common.company_name') }} </strong>(주)엑소미어</li>
            <li><strong>{{ __('common.representative') }}  </strong>정영철</li>
            <li><strong> {{ __('common.address') }} </strong> 서울 송파구 법원로11길 11 (문정동, 문정현대지식산업센터1-1)&nbsp;A동
                204호
            </li>
            <li><strong> Tel.</strong> {{ __('common.tel') }}</li>
        </ul>
        <img src="{{asset('img/logo_white.svg')}}" alt="logo" class="w-32 max-lg:hidden">
    </div>
    <hr class="border-y-white-300">
    <ul class="flex flex-wrap gap-x-3 p-7 lg:p-12 lg:pt-6">
        <li class="font-bold"><a href="#!">{{ __('common.privacy_policy') }}</a></li>
        <li><a href="#!">{{ __('common.terms_of_service') }}</a></li>
        <li class="w-full  mt-2 lg:mt-0 lg:order-first lg:flex-1">© 2024 EXOMERE™. All Rights Reserved.</li>
    </ul>

</footer>
