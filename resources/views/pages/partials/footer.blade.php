<footer id="footer"
        class="w-full bg-exomere font-light text-sm text-white">

    <div class="flex flex-wrap gap-x-3 p-7 lg:p-12">
        <ul class="flex flex-col lg:flex-1 lg:inline-flex lg:gap-y-3">
            @if (request()->session()->get('director_code') != '29151')
                <li><strong>{{ __('common.company_name') }} </strong> {{request()->session()->get('director_company')  ?? '(주)엑소미어' }} </li>
                <li><strong>{{ __('common.representative') }}  </strong>{{request()->session()->get('director_name')  ?? '정영철'}}</li>
                <li><strong> {{ __('common.address') }} </strong> {{request()->session()->get('director_address')  ?? '서울 송파구 법원로11길 11 (문정동, 문정현대지식산업센터1-1)'}} 
                                                                    {{request()->session()->get('director_address_detail')  ?? 'A동 204호'}}</li>
                <li><strong> Tel.</strong> {{request()->session()->get('director_phone') ?? '02-1577-1586' }}</li>
             @else
                <li><strong> COMPANY.</strong> (주)엑소미어</li>
                <li><strong> CEO.</strong> 정영철</li>
                <li><strong> Tel.</strong> 02-1577-1586</li>
                <li><strong> BUSINESS LICENCE.</strong> 453-87-02974 <a style='cursor: pointer;' onclick="javascript:window.open('https://www.ftc.go.kr/bizCommPop.do?wrkr_no=4538702974', '_blank','width=650,height=900,left=200,top=200');">[사업자정보확인]</a></li>
                <li><strong> E-COMMERCE PERMINT.</strong> 제 2024-서울송파-0603</li>
                <li><strong> ADDRESS.</strong> 05836 서울특별시 송파구 법원로11길 11, 2층 204호 (문정동, 문정현대 지식산업센터1-1)</li>
                <li><strong> PERSONL INFORMATION MANAGER.</strong> 김영아(exomere@exomere.com) </li>
            @endif  
        </ul>
        <img src="{{asset('img/logo_white.svg')}}" alt="logo" class="w-32 max-lg:hidden">
    </div>
    <hr class="border-y-white-300">
    <ul class="flex flex-wrap gap-x-3 p-7 lg:p-12 lg:pt-6">
        <li class="font-bold"><a href="#!">{{ __('common.privacy_policy') }}</a></li>
        <li><a href="#!">{{ __('common.terms_of_service') }}</a></li>
        <li class="w-full  mt-2 lg:mt-0 lg:order-first lg:flex-1">© {{date("Y-m-d")}} {{request()->session()->get('director_company') ?? '(주)엑소미어' }}. All Rights Reserved.</li>
    </ul>

</footer>

<a id="top"
   class="hidden fixed bottom-16 right-4 lg:right-12 z-[200] rounded-full border border-solid border-head text-head bg-[rgba(255,255,255,0.5)] cursor-default">
    <div class="flex flex-col w-12 h-12 justify-center items-center">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
             viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="m5 15 7-7 7 7"/>
        </svg>
        <span class="text-[11px]">TOP</span>
    </div>
</a>