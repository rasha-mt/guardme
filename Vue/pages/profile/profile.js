class Errors{
    constructor() {
        this.formErrors = { };
    }
    get(field) {
        if(this.formErrors[field]) {
            return this.formErrors[field][0];
        }
    }
    record(errors) {
        this.formErrors = errors;
    }
}

new window.App({
    el: '#app',
    data : function(){
        return {
            profile: {
                id: '',
                email: '',
                username: '',
                phone_number: '',
                dob: '',
                address: '',
                password: ''
            },
            password: null,
            alertMessage: '',
            profilePicture: '/assets/img/profile-default.png',
            formErrors: new Errors()
        }
    },
    methods : {
        getUserJobProfile : function (user) {
            
            window.axios.get(`/api/account/profile/get-user-profile`)
                .then((response) => {
                this.profile.id = response.data.id;
                this.profile.email = response.data.email;
                this.profile.username = response.data.username;
                this.profile.phone_number = response.data.phone_number;
                this.profile.dob = response.data.dob;
                this.profile.address = response.data.address;
                    //console.log('user profile', this.profile);
        });
        },
        onProfileSubmit : function () {
            this.profile.password = this.password;
            window.axios.post(`/api/account/profile/save-profile-data`, this.profile)
                .then((response) => {
                    this.password = '';
                    if (!response.data.errors.length) {
                        this.alertMessage = 'Data has been updated Successfully';
                    } else {
                        this.formErrors.record(response.data.errors);
                    }
                });
        }
    },
    components : {

    },
    mounted: function () {
        this.getUserJobProfile();
    },
    created : function(){

    }
});