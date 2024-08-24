@extends('pages.layouts.app')

@section('layoutContent')

    @include('pages.partials.header')

    @yield('content')

    @include('pages.partials.footer')
@endsection
