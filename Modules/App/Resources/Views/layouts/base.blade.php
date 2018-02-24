<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Security Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{csrf_token()}}" >
    <meta name="fid" content="{{env('FACEBOOK_ID','1966592423622448')}}" >
    <meta name="_aut" content="{{getAuthUserToken()}}" >
    <meta name="api-token" content="{{auth()->user() ? auth()->user()->api_token : null}}" >
    <link rel="shortcut icon" href="/favicon.ico" />
    <!-- Styles -->
    @section('styles')
    <style>
        @php
            include(public_path().'/build/css/site.vendors.bundle.css');
            include(public_path().'/build/css/site.bundle.css');
        @endphp
    </style>
    @show

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'AIzaSyB6lc7ZEn9sp6wAK9QgmxbiMoxkkiz99JU') }}" ></script>

    @stack('styles')
</head>
<body class="uk-position-relative">

<div id="pageLoader" class="uk-position-top h-100 uk-position-fixed white " style="z-index: 100000;">
    <div class="uk-position-center">
        <div class="d-inline-block p-1 circular ui image grey lighten-4"
             style="width: 140px; height: 140px;">
            <div class="p-2 h-100 fluid white circular">
                <div class="ui image uk-background-contain circular
                            white h-100 fluid"
                     style="background-image: url(/assets/img/logo_2.png)">
                </div>
            </div>
        </div>
    </div>
</div>

@yield('base')


@section('scripts')
<script src="/build/js/site.vendors.bundle.js"></script>
<script src="/build/js/app.min.js"></script>
@show

@stack('scripts')
<script>
    $(document).ready(function () {
        $('#pageLoader').addClass('uk-hidden');
    })
</script>
</body>
</html>

