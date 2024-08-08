@extends('layouts/blankLayout')

@section('title', __('messages.register'))

@section('page-style')
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mx-1 mx-md-4 mt-4">
                                        <a href="/">
                                            <img class="mb-4" src="//exomere.co.kr/common/image/logo/logo_horizontal.svg" alt="" width="172" height="57">
                                        </a>
                                    </p>

                                    <form action="{{ route('register') }}" method="POST" class="mx-1 mx-md-4">
                                        @csrf

                                        {{-- ID --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-id-badge fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="member_id">
                                                    {{ __('messages.member_id') }} <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="member_id" id="member_id" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('member_id') }}" required/>
                                                    <button type="button" class="btn btn-outline-secondary" onclick="checkID()">{{ __('messages.submit') }}</button>
                                                </div>
                                                <div id="idCheckFeedback" class="mt-1"></div>

                                                @error('member_id')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Name --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="name">
                                                    {{ __('messages.name') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="name" id="name" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('name') }}" required/>

                                                @error('name')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="phone">
                                                    {{ __('messages.phone') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="phone" id="phone" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('phone') }}" required/>

                                                @error('phone')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="password">
                                                    {{ __('messages.password') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="password" name="password" id="password" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" required/>

                                                @error('password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="password_confirmation">
                                                    {{ __('messages.password_confirmation') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required/>

                                                @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="email">
                                                    {{ __('messages.email') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" name="email" id="email" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('email') }}" required/>

                                                @error('email')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Local Store --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-store fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="local_store">
                                                    {{ __('messages.local_store') }} <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select" name="local_store" id="local_store" required>
                                                    <option>---지역점 선택--</option>
                                                    <option value="0000|본사" selected>본사</option>
                                                    <option value="0001|익산중앙">익산중앙</option>
                                                    <option value="0002|송파구 갑">송파구 갑</option>
                                                    <option value="0003|충남 계룡">충남 계룡</option>
                                                    <option value="0004|부천시 을">부천시 을</option>
                                                    <option value="0005|천안시병">천안시병</option>
                                                    <option value="0006|부평구 갑">부평구 갑</option>
                                                    <option value="0007|고양시병">고양시병</option>
                                                    <option value="0008|상록을">상록을</option>
                                                    <option value="0009|고양시 을">고양시 을</option>
                                                    <option value="0010|고양시 정">고양시 정</option>
                                                    <option value="0011|제주시 갑">제주시 갑</option>
                                                    <option value="0012|김포시 갑">김포시 갑</option>
                                                    <option value="0013|광산구 을">광산구 을</option>
                                                    <option value="0014|구리시">구리시</option>
                                                    <option value="0015|양천구갑">양천구갑</option>
                                                    <option value="0016|대구수성갑">대구수성갑</option>
                                                    <option value="0017|서초구갑">서초구갑</option>
                                                    <option value="0018|성남수정구">성남수정구</option>
                                                    <option value="0019|송파구 을">송파구 을</option>
                                                    <option value="0020|수원시 정">수원시 정</option>
                                                    <option value="0021|강남구갑">강남구갑</option>
                                                    <option value="0022|연수구 갑">연수구 갑</option>
                                                    <option value="0023|대전서구 갑">대전서구 갑</option>
                                                    <option value="0024|연수구을">연수구을</option>
                                                    <option value="0025|노원구갑">노원구갑</option>
                                                    <option value="0026|분당구갑">분당구갑</option>
                                                    <option value="0027|영등포구을">영등포구을</option>
                                                    <option value="0028|성남중원">성남중원</option>
                                                    <option value="0029|남양주갑">남양주갑</option>
                                                    <option value="0030|제주시 을">제주시 을</option>
                                                    <option value="0031|강남구 병">강남구 병</option>
                                                    <option value="0032|사하구갑">사하구갑</option>
                                                    <option value="0033|양주시">양주시</option>
                                                    <option value="0034|동대문갑">동대문갑</option>
                                                    <option value="0035|강남구을">강남구을</option>
                                                    <option value="0036|분당구 을">분당구 을</option>
                                                    <option value="0037|대전 유성구">대전 유성구</option>
                                                    <option value="0038|수원시 을">수원시 을</option>
                                                    <option value="0039|수원시 병">수원시 병</option>
                                                    <option value="0040|여수시 갑">여수시 갑</option>
                                                    <option value="0041|여수시 을">여수시 을</option>
                                                    <option value="0042|대구서구 갑">대구서구 갑</option>
                                                    <option value="0043|순천시 갑">순천시 갑</option>
                                                    <option value="0044|핑크">핑크</option>
                                                    <option value="0045|관악구 갑">관악구 갑</option>
                                                </select>

                                                @error('local_store')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Recommend ID --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user-tie fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="recommend_id">
                                                    {{ __('messages.recommend_id') }} <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <input type="hidden" name="recommend_seq" id="recommend_seq" value="{{ $recommendSeq ?? old('recommend_seq') }}" />
                                                    <input type="text" name="recommend_id" id="recommend_id" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ $recommendSeq ? $recommendId : old('recommend_id') }}" required/>
                                                    <input type="text" name="recommend_name" id="recommend_name" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ $recommendSeq ? $recommendName :  old('recommend_name') }}" readonly/>
                                                    <button type="button" class="btn btn-outline-secondary" onclick="checkRecommendId()">{{ __('messages.submit') }}</button>
                                                </div>

                                                @error('recruiter_id')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-map-marker-alt fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="address">
                                                    {{ __('messages.address') }} <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">
                                                    <input type="text" name="zipcode" id="zipcode" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('zipcode') }}" placeholder="{{ __('messages.zipcode') }}" readonly required/>
                                                    <button type="button" class="btn btn-outline-secondary" onclick="getPostCode();">{{ __('messages.search') }}</button>
                                                </div>
                                                <input type="text" name="address" id="address" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('address') }}" placeholder="{{ __('messages.address') }}" readonly required/>
                                                <input type="text" name="address_detail" id="address_detail" class="form-control" aria-describedby="inputGroupPrepend" autocomplete="false" value="{{ old('address_detail') }}" placeholder="{{ __('messages.address_detail') }}" required/>

                                                @error('address')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Nation --}}
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-globe fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="nation">
                                                    {{ __('messages.nation') }} <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control" name="nation" id="nation" required>
                                                    <option value="">-선택-</option>
                                                    <option value="KR|대한민국">대한민국</option>
                                                </select>

                                                @error('nation')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required/>
                                            <label class="form-check-label" for="form2Example3">
                                                <a href="#!">이용약관</a>에 동의합니다.
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.register') }}</button>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <p class="m-0">
                                                이미 회원이시라면? <a href="{{ route('login') }}">로그인</a>
                                            </p>
                                        </div>
                                        <p class="text-center mt-5 mb-3 text-muted">© 2024 EXOMERE™. All Rights Reserved.
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2" style="background-image: url('{{asset('img/visual_02.webp')}}'); background-size: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
    <script>
        const password = document.getElementById("password");
        const password_confirmation = document.getElementById("password_confirmation");

        function validatePassword() {
            if (password.value !== password_confirmation.value) {
                password_confirmation.setCustomValidity("{{ __('messages.invalid_password_confirmation') }}");
            } else {
                password_confirmation.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        password_confirmation.onkeyup = validatePassword;

        function checkID() {
            const memberID = document.getElementById("member_id").value;
            const feedback = document.getElementById("idCheckFeedback");

            fetch(`/check-id?member_id=${memberID}`)
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        feedback.innerHTML = `<span class="text-success">ID is available!</span>`;
                    } else {
                        feedback.innerHTML = `<span class="text-danger">ID is already taken.</span>`;
                    }
                })
                .catch(error => {
                    feedback.innerHTML = `<span class="text-danger">Error checking ID.</span>`;
                });
        }

        function checkRecommendId() {
            const recommendId = document.getElementById("recommend_id").value;
            const recommendName = document.getElementById("recommend_name");
            const recommendSeq = document.getElementById("recommend_seq");

            fetch(`/check-recommend-id?recommend_id=${recommendId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        console.log(data);
                        recommendSeq.value = data.recommendSeq;
                        recommendName.value = data.recommendName;
                    } else {
                        recommendSeq.value = '';
                        recommendName.value = '';
                        alert("Recommend ID not found.");
                    }
                })
                .catch(error => {
                    recommendSeq.value = '';
                    recommendName.value = '';
                    alert("Error checking Recommend ID.");
                });
        }

        function getPostCode(){
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if(data.userSelectedType === 'R'){
                        //법정동명이 있을 경우 추가한다.
                        if(data.bname !== ''){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if(data.buildingName !== ''){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    //document.getElementById("sample6_postcode1").value = data.postcode1;
                    //document.getElementById("sample6_postcode2").value = data.postcode2;
                    //document.getElementById("sample6_address").value = fullAddr;

                    // 커서를 상세주소 필드로 이동한다.
                    //document.getElementById("sample6_address2").focus();

                    var postArr = new Array();
                    postArr.push(data.zonecode);
                    postArr.push(fullAddr);

                    setPostCode(postArr);
                }
            }).open();
        }

        function setPostCode(postArr){
            const zip_code = postArr[0];
            const full_addr = postArr[1];

            $("#zipcode").val(zip_code);
            $("#address").val(full_addr);
            $("#address_detail").val('');
            $("#address_detail").focus();
        }
    </script>
@endsection