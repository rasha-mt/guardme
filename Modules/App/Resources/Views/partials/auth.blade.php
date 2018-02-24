<div id="auth">

    <gm-response-messenger> </gm-response-messenger>

    <div class="popup-sec">
        <div class="account-popup login-account">
            <span class="close-account">x</span>
            <div class="logo">
                <a href="#" title="">
                    <div class="d-inline-block p-1 circular ui image grey lighten-4"
                         style="width: 110px; height: 110px;">
                        <div class="p-2 h-100 fluid white circular">
                            <div class="ui image uk-background-contain
                            white h-100 fluid"
                                 style="background-image: url(/assets/img/logo_2.png)">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <p>Don't have an Account? <a href="#" class="account-register" title="">Register Now</a></p>
            <h4>LOGIN HERE</h4>
            <form @submit.prevent="login()">
                <input type="text" placeholder="Email Address" v-model="credentials.email"/>
                <input type="password" placeholder="Password" v-model="credentials.password"/>
                <input type="submit" value="LOGIN HERE" />
            </form>
            <div class="find-us-on">
                <h4>or connect with:</h4>
                <ul class="social-btns">
                    <li>
                        <button class="ui circular facebook icon button">
                            <i class="facebook icon"></i>
                        </button>
                    </li>
                    <li>
                        <button class="ui circular twitter icon button">
                            <i class="twitter icon"></i>
                        </button>
                    </li>
                    <li>
                        <button class="ui circular linkedin icon button">
                            <i class="linkedin icon"></i>
                        </button>
                    </li>
                    <li>
                        <button class="ui circular google plus icon button">
                            <i class="google plus icon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="account-popup register-account">
            <span class="close-account">x</span>
            <div class="logo">
                <a href="#" title="">
                    <div class="d-inline-block p-1 circular ui image grey lighten-4"
                         style="width: 110px; height: 110px;">
                        <div class="p-2 h-100 fluid white circular">
                            <div class="ui image uk-background-contain
                            white h-100 fluid"
                                 style="background-image: url(/assets/img/logo_2.png)">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <p>If you already have an account <a href="#" title="" class="account-login">Sign in</a></p>
            <h4>REGISTER HERE</h4>
            <form @submit.prevent="register()">
                <input type="email" placeholder="Your Email Address" v-model="registration.email"/>
                <input type="password" placeholder="Password" v-model="registration.password"/>
                <input type="password" placeholder="Re-type Password" v-model="registration.retype_password"/>

                <div class="row w-100 m-0 d-flex justify-content-between">
                    <div class="col-12 p-3 white">
                        <div class="ui radio checkbox">
                            <input type="radio" name="role" tabindex="0" value="true"
                                   class="hidden" v-model="registration.isEmployer">
                            <label class="my-2">I am an Employer</label>
                        </div>

                        <div class="ui radio checkbox">
                            <input type="radio" name="role" tabindex="0" value="false"
                                   class="hidden" v-model="registration.isEmployer">
                            <label class="my-2">I am a Freelancer</label>
                        </div>
                    </div>
                </div>

                <input type="submit" class="mt-3" value="REGISTER NOW" />
            </form>
        </div>
    </div>

    @include('app::partials.splashscreen')


</div>

@push('scripts')
    <script src="/build/js/auth.min.js"></script>
    <script>
        $('.ui.radio.checkbox')
            .checkbox()
        ;
    </script>
@endpush