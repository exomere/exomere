@extends('layouts/blankLayout')

@section('title', '로그인')

@section('page-style')
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('content')
    <main class="form-signin text-center" style="background-color: #fff;border-radius: 25px">
        <form id="formAuthentication" action="{{route('login.perform')}}" method="POST">
            @csrf
            <a href="/">
                <img class="mb-4" src="//exomere.co.kr/common/image/logo/logo_horizontal.svg" alt="" width="172"
                     height="57">
            </a>
            <h1 class="h3 mb-3 fw-normal">로그인</h1>

            <div class="form-floating mb-1">
                <input type="text" name="id" class="form-control" id="floatingInput" placeholder="ID를 입력하세요" aria-describedby="inputGroupPrepend" >
                <label for="floatingInput">ID</label>
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" aria-describedby="inputGroupPrepend"
                       placeholder="비밀번호를 입력하세요">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> 아이디 기억하기
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">로그인</button>
            <p class="mt-4">
                아직 회원이 아니시라면?
                <button class="border-primary btn btn-lg text-primary w-100" type="button"
                        onclick="location.href='{{url('signup')}}'">회원가입
                </button>
            </p>
            <p class="mt-5 mb-3 text-muted">© 2024 EXOMERE<sup>™</sup>. All Rights Reserved.
            </p>
        </form>
    </main>
@endsection
