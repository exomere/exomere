@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body" style='background-color:#e06850; color:#fff;'>
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
                <img src='/img/logo_footer_white.png' style='margin-left:5px; width:350px;'></a>
            </a>
          </div>
          <!-- /Logo -->
          <form id="formAuthentication" class="mb-3" action="{{route('login.perform')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="id" class="form-label" style='color:#fff;'>ID</label>``
              <input type="text" class="form-control" id="id" name="id" placeholder="ID를 입력해주세요" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password" style='color:#fff;'>Password</label>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit" style='background-color:#fff; color:#e06850;'>Sign in</button>
            </div>
          </form>

          <p class="text-center">
            <a href="{{url('auth/register-basic')}}">
              <span style='color:#fff;'>회원가입</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
