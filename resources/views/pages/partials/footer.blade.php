<footer id="footer"
        class="w-full bg-exomere font-light text-sm text-slate-200">

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

<a id="top"
   class="hidden fixed bottom-16 right-4 lg:right-12 z-[200] rounded-full border border-solid border-baseColor text-baseColor bg-[rgba(255,255,255,0.5)] cursor-default">
    <div class="flex flex-col w-12 h-12 justify-center items-center">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
             viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="m5 15 7-7 7 7"/>
        </svg>
        <span class="text-[11px]">TOP</span>
    </div>
</a>
