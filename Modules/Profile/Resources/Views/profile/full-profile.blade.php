@extends("app::layouts.app")
<style>
    .profile-picture {
        border-radius: 4px;
        margin-bottom: 5px;
    }
    .select-image {
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
        height: 30px;
        position: relative;
        text-align: center;
        top: -35px;
        cursor: pointer;
    }
    .upload-btn {
        position: relative;
        top: -30px;
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
                <div class="alert alert-success" role="alert" v-if="alertMessage" v-text="alertMessage"></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="profile-picture" :src="profilePicture" alt="">
                            <input type="file" style="display: none;">
                            <div class="select-image">
                                Choose Profile Picture
                            </div>
                            <button class="btn btn-primary upload-btn">Upload</button>
                        </div>
                    </div>
                    <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data" @submit.prevent="onProfileSubmit">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Username: </label>
                            <div>
                                <input class="form-control" type="text" name="username" placeholder="Username" v-model="profile.username"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('username')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email: </label>
                            <div>
                                <input class="form-control" type="text" name="email" placeholder="Email" v-model="profile.email"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('email')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Date of Birth: </label>
                            <div>
                                <input class="form-control" type="text" name="dob" placeholder="mm-dd-yyyy" v-model="profile.dob"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('dob')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Address: </label>
                            <div>
                                <input class="form-control" type="text" name="address" placeholder="Address" v-model="profile.address"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('address')"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone Number: </label>
                            <div>
                                <input class="form-control" type="text" name="phone_number" placeholder="Phone Number" v-model="profile.phone_number"/>
                            </div>
                            <span class="text-danger" v-text="formErrors.get('phone_number')"></span>
                        </div>



                        <div class="form-group">
                            <label class="control-label">Password: </label>
                            <div>
                                <input class="form-control" type="password" name="password" placeholder="Password" v-model="password"/>
                            </div>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
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