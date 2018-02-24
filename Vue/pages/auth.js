new window.App({
    el: '#auth',
    data : function(){
        return {
            credentials : {
                email: '',
                password : ''
            },
            requesting : false,
            registration : {
                email: '',
                password : '',
                retype_password : '',
                isEmployer : false
            },
            sending : false,
            message : 'Working. Please wait...'
        }
    },
    methods : {
        login: function(){
            // TODO:: login the user
            var vm = this;

            vm.requesting = true;

            vm.$root.showSplashScreen('Signing in.... Please wait!');

            window.axios.post('/account/login', vm.credentials)
                .then(function(response){
                    vm.requesting = false;

                    vm.$root.showSplashScreen(vm.$root.greetPerson(response.data.user.username));

                    var redirect = vm.$root.getUrlVars()['redirect'];

                    if(!redirect) {
                        redirect = response.data.redirect;
                    }

                    window.location.href = redirect;
                }).catch(function (error) {

                    vm.$root.hideSplashScreen();
            });
        },
        register: function(){
            // TODO:: login the user
            var vm = this;

            vm.$root.showSplashScreen('Creating your account.... Please wait!');

            window.axios.post('/api/account/register', vm.registration)
                .then(function(response){
                    vm.requesting = false;

                    var redirect = vm.$root.getUrlVars()['redirect'];

                    if(!redirect) {
                        redirect = '/congratulations';
                    }
                    window.location.href = redirect;
                }).catch(function (error) {
                vm.$root.hideSplashScreen();
            });
        },
    },
    components : {

    },
    created : function(){
        var vm = this;

        var popup = vm.$root.getUrlVars()['popup'];

        if(popup === 'login'){
            $('.popup-sec').addClass('active');
            $('.login-account').addClass('active');
            $('html').addClass('stop-scroll');
        }
        if(popup === 'register'){
            $('.popup-sec').addClass('active');
            $('.register-account').addClass('active');
            $('html').addClass('stop-scroll');
        }
    }
});