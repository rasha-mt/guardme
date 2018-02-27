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
                password: '',
                profilePicture: '/assets/img/profile-default.png'
            },
            password: null,
            alertMessage: '',
            selectedFile: null,
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
                    if (response.data.profile_picture) {
                        this.profile.profilePicture = response.data.profile_picture;
                    }
        });
        },
        onProfileSubmit : function () {
            this.profile.password = this.password;
            window.axios.post(`/api/account/profile/save-profile-data`, this.profile)
                .then((response) => {
                    console.log(response.data);
                    this.password = '';
                    if (response.data.errors.length == 0) {
                        this.formErrors.record(response.data.errors);
                        this.alertMessage = 'Data has been updated Successfully';
                    } else {
                        this.formErrors.record(response.data.errors);
                    }
                });
        },
        onFileSelected(event) {
            console.log(event);
            this.selectedFile = event.target.files[0];
            this.previewThumbnail(event);
        },
        onUpload() {
            const fd = new FormData();
            fd.append('profile_picture', this.selectedFile, this.selectedFile.name);
            axios.post('/api/account/profile/upload-profile-picture', fd, {
                onUploadProgress: uploadEvent => {
                    console.log('upload Perogress: ' + Math.round(uploadEvent.loaded / uploadEvent.total * 100) + '%')
                }
            })
                .then((response) => {
                    console.log(response);
                })

        },
        previewThumbnail: function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                    vm.profile.profilePicture = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
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