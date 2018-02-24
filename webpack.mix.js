let mix = require('laravel-mix');
mix
    .sass('XVendors/site.vendors.scss', 'public/build/css/site.vendors.bundle.css')
    .sass('XVendors/app.vendors.scss', 'public/build/css/app.vendors.bundle.css')
    .sass('Sass/site.main.scss', 'public/build/css/site.bundle.css')
    .sass('Sass/app.main.scss', 'public/build/css/app.bundle.css')
   
    .scripts([
        'XVendors/theListing/js/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/semantic-ui/dist/semantic.min.js',
        'node_modules/uikit/dist/js/uikit.min.js',
        'XVendors/theListing/js/modernizr.js',
        'XVendors/theListing/js/script.js',
        'XVendors/theListing/js/slick.min.js',
        'XVendors/theListing/js/parallax.js',
        'XVendors/theListing/js/scrollbar.js',
        'XVendors/theListing/js/rangeslider.js'
    ], 'public/build/js/site.vendors.bundle.js')

    .scripts([
        'XVendors/eliteAdmin/plugins/bower_components/jquery/dist/jquery.min.js',
        'XVendors/eliteAdmin/bootstrap/dist/js/tether.min.js',
        'XVendors/eliteAdmin/bootstrap/dist/js/bootstrap.min.js',
        'XVendors/eliteAdmin/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js',
        'XVendors/eliteAdmin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'XVendors/eliteAdmin/js/jquery.slimscroll.js',
        'XVendors/eliteAdmin/js/waves.js',
        'XVendors/eliteAdmin/js/custom.min.js',
        'XVendors/eliteAdmin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
        'node_modules/semantic-ui/dist/semantic.min.js'
    ], 'public/build/js/app.vendors.bundle.js')

.ts('Vue/bootstrap/app.ts', 'public/build/js/app.min.js')
.js('Vue/pages/auth.js', 'public/build/js/auth.min.js')
.js('Vue/pages/dashboard/dashboard.js', 'public/build/js/backend/dashboard.min.js')
.js('Vue/pages/create-job.js', 'public/build/js/create-job.min.js')
.js('Vue/pages/jobs/active-schedule.js', 'public/build/js/backend/jobs/active-schedule.min.js')
;
