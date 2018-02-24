require('../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            job : {
                title: '',
                description : '',
                address : {
                    line1 : '',
                    line2 : '',
                    line3 : '',
                    line4 : '',
                    locality : '',
                    city : '',
                    county : '',
                    coord : {
                        latt : '',
                        long : ''
                    },
                    houseNumber : '',
                },
                county : 0,
                city : 0,
                postcode : '',
                time : {
                    start : '',
                    end : ''
                },
                wages : 0,
                rating : 0,
                company : null,
                categories : [],
                sectors : [],
                broadcastsConfig : []
            },
            counties : {
                loading : false,
                data : [],
                selected_county_id : null
            },
            cities : {
                loading : false,
                data : []
            },
            company : {
                data : {
                    name : '',
                    email : '',
                    address : '',
                    phone : '',
                },
                saving : false
            },
            companies : {
                data : [],
                loading : false
            },
            categories : {
                data : [],
                loading : false
            },
            sectors : {
                data : [],
                loading : false
            },
            broadcastsConfig : {
                data : null,
                loading : false
            },
            ratingMessage : 'Minimum wage for all SIA Personnel is £8.00',
            step : 1
        }
    },
    methods : {
        continue: function () {
            this.step++;
        },
        previous: function () {
            this.step--;
        },
        save: function () {
            var vm = this;

            vm.job.company_id = vm.$root.getUrlVars()['company'];

            vm.$root.showSplashScreen('Saving....');

            window.axios.post('/api/jobs/new', vm.job)
                .then(
                    function (response) {
                        vm.$root.showSplashScreen('Job saved! Redirect....');
                        window.location.href = '/account/jobs/schedule';
                    }
                )
                .catch(function (e) {
                    vm.$root.hideSplashScreen();
                });
        },

        validateFinishForm: function(scope) {
            var vm = this;

            this.$validator.validateAll(scope).then(function(result) {
                if (result) {
                    vm.save();
                } else {
                    alert('You have provided invalid data. Please check again!')
                }
            });
        },

        validateForm: function(scope) {
            var vm = this;

            this.$validator.validateAll(scope).then(function(result) {
                if (result) {
                    vm.continue();
                } else {
                    alert('You have provided invalid data. Please check again!')
                }
            });
        },

        loadCounties : function () {
            var vm = this;
            vm.counties.loading = true;

            window.axios.get('/api/app/counties')
                .then(function (response) {

                    response.data.forEach(function (county) {
                        vm.counties.data.push(county);
                    });

                    setTimeout(function () {
                        vm.counties.loading = false;

                        $('.ui.dropdown.counties')
                            .dropdown({
                                onChange: function(value, text, $selectedItem) {
                                    // custom action
                                    vm.counties.selected_county_id = value;
                                    vm.job.county = value;
                                }
                            })
                        ;
                    }, 1000)
                });
        },

        loadCities : function (selected_county_id) {
            var vm = this;
            vm.cities.loading = true;

            window.axios.get('/api/app/counties/' + selected_county_id + '/cities')
                .then(function (response) {

                    vm.cities.data = [];

                    response.data.forEach(function (city) {
                        vm.cities.data.push(city);
                    });

                    setTimeout(function () {
                        vm.cities.loading = false;

                        $('.ui.dropdown.cities')
                            .dropdown({
                                onChange: function(value, text, $selectedItem) {
                                    vm.job.city = value;
                                }
                            })
                        ;
                    }, 1000)
                });
        },

        newCompanyModal : function () {
            $('.ui.modal')
                .modal('show')
            ;
        },

        validateNewCompanyForm: function(scope) {
            var vm = this;

            this.$validator.validateAll(scope).then(function(result) {
                if (result) {
                    vm.saveCompany();
                } else {
                    alert('You have provided invalid data. Please check again!')
                }
            });
        },

        saveCompany: function () {
            var vm = this;

            vm.company.saving = true;

            window.axios.post('/api/companies/new', vm.company.data)
                .then(
                    function (response) {
                        vm.$root.ukNotify(response.data.name + ' has been successfully created!');

                        vm.companies.data.push(response.data);

                        vm.company.saving = false;

                        vm.company.data = {
                            name : '',
                            email : '',
                            address : '',
                            phone : '',
                        };

                        $('.ui.modal')
                            .modal('hide')
                        ;
                    }
                );
        },

        loadCompanies : function () {
            var vm = this;
            vm.companies.loading = true;

            window.axios.get('/api/companies/auth')
                .then(function (response) {

                    response.data.forEach(function (company) {
                        vm.companies.data.push(company);
                    });

                    setTimeout(function () {
                        vm.companies.loading = false;

                        $('.ui.dropdown.company')
                            .dropdown({
                                onChange: function(value, text, $selectedItem) {
                                    if(value === 'new'){
                                        vm.newCompanyModal();
                                    } else {
                                        vm.job.company = value;
                                    }
                                }
                            })
                        ;
                    }, 1000)
                });
        },

        loadCategories : function () {
            var vm = this;
            vm.categories.loading = true;

            window.axios.get('/api/app/categories')
                .then(function (response) {

                    response.data.forEach(function (category) {
                        vm.categories.data.push(category);
                    });

                    setTimeout(function () {
                        $('.ui.checkbox')
                            .checkbox()
                        ;
                    }, 1000);

                    vm.categories.loading = false;
                });
        },

        loadSectors : function () {
            var vm = this;
            vm.sectors.loading = true;

            window.axios.get('/api/app/sectors')
                .then(function (response) {

                    response.data.forEach(function (sector) {
                        vm.sectors.data.push(sector);
                    });

                    setTimeout(function () {
                        $('.ui.checkbox')
                            .checkbox()
                        ;
                    }, 1000);

                    vm.sectors.loading = false;
                });
        },

        loadBroadcasts : function () {
            var vm = this;
            vm.broadcastsConfig.loading = true;

            window.axios.get('/api/app/broadcasts-config')
                .then(function (response) {

                    vm.broadcastsConfig.data = response.data;

                    vm.broadcastsConfig.loading = false;
                });
        },

        getAddress: function(postcode, houseNumber){
            const vm = this;

            if(postcode && houseNumber){
                var url = 'https://api.getAddress.io/find/'
                    + postcode + '/'
                    + houseNumber
                    + '?api-key=Wy--CPV0F0qQHzZgN-jabw12101';

                vm.$root.customUrlRequest(url, 'get').then(
                    function (response) {
                        const addresses = response.addresses[0].split(',');

                        vm.job.address.line1 = addresses[0].trim();
                        vm.job.address.line2 = addresses[1].trim();
                        vm.job.address.line3 = addresses[2].trim();
                        vm.job.address.line4 = addresses[3].trim();
                        vm.job.address.locality = addresses[4].trim();
                        vm.job.address.city = addresses[5].trim();
                        vm.job.address.county = addresses[6].trim();
                        vm.job.address.coord.latt = response.latitude;
                        vm.job.address.coord.long = response.longitude;

                        console.log('ADDRESS', addresses);

                    }
                ).catch(function (e) {
                    vm.job.address.line1 = '';
                    vm.job.address.line2 = '';
                    vm.job.address.line3 = '';
                    vm.job.address.line4 = '';
                    vm.job.address.locality = '';
                    vm.job.address.city = '';
                    vm.job.address.county = '';
                    vm.job.address.coord.latt = '';
                    vm.job.address.coord.long = '';
                });
            } else {
                console.log('INVALID', postcode, houseNumber);
            }
        }
    },
    components : {

    },
    watch : {
        'job.postcode' : function (newPostcode, oldPostCode) {
            this.getAddress(newPostcode, this.job.address.houseNumber);
        },
        'job.address.houseNumber' : function (newHouseNumber, oldHouseNumber) {
            this.getAddress(this.job.postcode, newHouseNumber);
        }
    },
    mounted : function(){
        var vm = this;

        this.loadCounties();
        this.loadCompanies();
        this.loadCategories();
        this.loadSectors();
        this.loadBroadcasts();

        this.$watch('counties.selected_county_id', function (newVal, oldVal) {
            if(newVal != oldVal){
                vm.loadCities(newVal);
            }
        });

        $('.rating.sia_staff_rating')
            .rating({
                onRate : function (value) {
                    vm.job.rating = value;

                    switch (value){
                        case 4 :
                            vm.ratingMessage = 'Consider offering 4-star SIA Personnel £10.00';
                            break;
                        case 5 :
                            vm.ratingMessage = 'Consider offering 5-star SIA Personnel £12.00';
                            break;
                        default:
                            vm.ratingMessage = 'Minimum wage for all SIA Personnel is £8.00';
                    }
                }
            })
        ;

        $('.ui.checkbox')
            .checkbox()
        ;

        $('.time-picker').datetimepicker({
            format: 'LT'
        }).on('change.datetimepicker', function(event){
            var time = event.target.value;
            var el_id = event.target.id;

            if(el_id === 'time_starts'){
                vm.job.time.start = time;
            } else {
                vm.job.time.end = time;
            }
        });
    }
});