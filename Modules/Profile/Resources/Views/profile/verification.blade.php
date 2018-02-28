@extends("app::layouts.app")
<style>
    .badges-row {
        margin-top: 10px;
    }
</style>
@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-home"></i> Profile </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row badges-row">
                        <div class="col-md-4">Security badge</div>
                        <div class="col-md-4"><button class="btn btn-primary">Upload</button></div>
                        <div class="col-md-4"><button class="btn btn-info">Download</button></div>
                    </div>
                    <div class="row badges-row">
                        <div class="col-md-4">Proof of work</div>
                        <div class="col-md-4"><button class="btn btn-primary">Upload</button></div>
                        <div class="col-md-4"><button class="btn btn-info">Download</button></div>
                    </div>
                    <div class="row badges-row">
                        <div class="col-md-4">Visa Page</div>
                        <div class="col-md-4"><button class="btn btn-primary">Upload</button></div>
                        <div class="col-md-4"><button class="btn btn-info">Download</button></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('styles')

@endpush

@push('scripts')
<script src="/build/js/backend/profile/profile.min.js"></script>
@endpush