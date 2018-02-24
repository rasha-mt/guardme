@extends('app::layouts.pages.others')

@section('page')
    <section>
        <div class="block no-padding uk-height-medium">?
            <div class="uk-position-top uk-background-center-left uk-height-1-1  w-100"
                 style="background: url(/assets/img/security_lady_man.jpg)">
                <div class="uk-position-top h-100 w-100 bg-black" style="opacity: 0.8"></div>
            </div>

            <div class="container h-100">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <span class="white"><span class="fg-site-blue">Guard</span><span class="fg-site-green">Me</span></span>
                            <h2>SIA Personnel Listings</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">

            </div>
        </div>
    </section>

    @include('app::partials.splashscreen')
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush