@extends('app::layouts.base')

@section('base')
    @if(auth()->guest())
        @include('app::partials.auth')
    @endif
    <div class="theme-layout" id="app">

        @include('app::partials.header')

        @yield('page')

        @include('app::partials.footer')

    </div>

@endsection