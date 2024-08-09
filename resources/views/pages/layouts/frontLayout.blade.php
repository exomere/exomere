@extends('pages.layouts.app')

@section('layoutContent')

    @include('pages.partials.header')

    @yield('content')

    @if(! $isMain)
        {{--메인페이지 스크롤스냅안에 배치함--}}
        @include('pages.partials.footer')
    @endif
@endsection
