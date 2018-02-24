@extends("app::layouts.app")

@section('app')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="fa fa-tasks"></i> Active Job Schedule </h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 uk-text-right uk-lead">
            You are logged in as: <span class="fg-site-theme">@{{ $root.app.user ? $root.app.user.primaryRole.name : '' }}</span>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-9">
            <div class="white-box">
                <h3 class="box-title">Active Job Listing</h3>
                <div class="comment-center">
                    <div class="comment-body w-100" v-for="job in activeJobs">
                        <div class="h-100 user-img" style="width: 180px !important;">
                            <google-map :name="job.id"
                                        :height="130"
                                        :markers="[{latitude: job.address.coord.latitude,
                                        longitude: job.address.coord.longitude}]">
                            </google-map>
                        </div>
                        <div class="mail-contnet">
                            <h5>@{{ job.title }}</h5>
                            <span class="mail-desc fluid d-block" v-html="job.description"></span>

                            <a href="#" class="label label-rouded label-info"><i class="icon pause"></i> Pause</a>
                            <a href="#" class="label label-rouded label-inverse"><i class="icon edit"></i> Edit</a>
                            <a href="#" class="label label-rouded label-warning"><i class="icon unhide"></i> Preview</a>
                            <span class="time pull-right uk-text-middle">
                                <i class="icon clock large "></i>
                                @{{ job.publishedOn.diff }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box text-center">
                        <h1 class="counter">@{{ activeJobs.length }}</h1>
                        <p class="">Active</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box bg-info text-center">
                        <h1 class="counter text-white">0</h1>
                        <p class="text-white">Completed</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="white-box bg-warning text-center">
                        <h1 class="counter text-white">0</h1>
                        <p class="text-white">On-going</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/backend/jobs/active-schedule.min.js"></script>
@endpush