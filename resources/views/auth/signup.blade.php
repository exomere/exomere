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
                                            <img class="mb-4" src="//exomere.co.kr/common/image/logo/logo_horizontal.svg"
                                                 alt="" width="172"
                                                 height="57">
                                        </a>
                                    </p>

                                    <form action="{{ route('register') }}" method="POST" class="mx-1 mx-md-4">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0 ">
                                                <label class="form-label"
                                                       for="name">{{ __('messages.name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                       aria-describedby="inputGroupPrepend" autocomplete="false"
                                                       value="{{ old('name') }}" required/>
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="email">{{ __('messages.email') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                       aria-describedby="inputGroupPrepend" autocomplete="false"
                                                       value="{{ old('email') }}" required/>
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label"
                                                       for="password">{{ __('messages.password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" id="password"
                                                       aria-describedby="inputGroupPrepend" autocomplete="false"
                                                       class="form-control" required/>

                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label"
                                                       for="confirm_password">{{ __('messages.confirm_password') }}</label>
                                                <input type="password" name="confirm_password"
                                                       aria-describedby="inputGroupPrepend" autocomplete="false"
                                                       id="confirm_password" class="form-control" required/>

                                                @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                   id="form2Example3c" required/>
                                            <label class="form-check-label" for="form2Example3">
                                                <a href="#!">이용약관</a>에 동의합니다.
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-primary btn-lg">{{ __('messages.register') }}
                                            </button>
                                        </div>


                                        <div class="d-flex justify-content-center">
                                            <p class="m-0">
                                                이미 회원이시라면? <a href="location.href='{{url('login')}}'">로그인</a>
                                            </p>

                                        </div>
                                        <p class="text-center mt-5 mb-3 text-muted">© 2024 EXOMERE™. All Rights Reserved.

                                    </form>

                                </div>
                                <div
                                    class=" col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2 d-xs-none"
                                    style="background-image: url('{{asset('img/visual_02.webp')}}'); background-size: cover;">
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
    <script>
        var password = document.getElementById("password")
            , confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("{{ __('messages.invalid_confirm_password') }}");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
@endsection