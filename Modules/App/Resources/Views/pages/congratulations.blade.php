@extends('app::layouts.base')

@section('base')
    <div class="h-100  uk-position-relative">
        <div class="uk-position-center w-50">
            <div class="uk-text-center">
                <div class="d-inline-block p-1 circular ui image grey lighten-4"
                     style="width: 160px; height: 160px;">
                    <div class="p-2 h-100 fluid white circular">
                        <div class="ui image uk-background-contain
                            white h-100 fluid"
                             style="background-image: url(/assets/img/logo_2.png)">
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="display-5 uk-text-center">
                Thank you for signing up! <br> Please check your e-mail to continue.
            </h5>
            <div class="uk-text-center">
                <a href="/?popup=login" class="button ui mini primary">Login to my account</a>
            </div>
        </div>

        <div class="uk-position-bottom-center d-flex justify-content-around" >
            <a href="/" class="p-3 fg-site-maroon fg-hover-site-green">Home</a>
            <a href="" class="p-3 fg-site-maroon fg-hover-site-green">About Us</a>
            <a href="" class="p-3 fg-site-maroon fg-hover-site-green">Freelancers</a>
            <a href="" class="p-3 fg-site-maroon fg-hover-site-green">Job Openings</a>
            <a href="" class="p-3 fg-site-maroon fg-hover-site-green">Blog</a>
            <a href="" class="p-3 fg-site-maroon fg-hover-site-green">FAQ</a>
        </div>
    </div>
@endsection