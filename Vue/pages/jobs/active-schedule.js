require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            activeJobs : []

        }
    },
    methods : {
        getActiveJobs : function () {
            const vm = this;

            window.axios.get('/api/jobs/auth/active')
                .then(function (response) {
                    const jobs = response.data;

                    jobs.forEach(function (job) {
                        vm.activeJobs.push(job);
                    })
                });
        }

    },
    components : {

    },
    created : function(){

    },
    mounted : function () {
        this.getActiveJobs();
    }
});