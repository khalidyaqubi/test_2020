const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/new_theam/css/bootstrap-datepicker3.css',
    'resources/new_theam/css/socicon.css',
    'resources/new_theam/css/line-awesome.css',
    'resources/new_theam/css/flaticon.css',
    'resources/new_theam/css/flaticon2.css',
    'resources/new_theam/css/all.min.css',
    'resources/new_theam/css/bootstrap-select.css',
    'resources/new_theam/css/select2.css',
    'resources/new_theam/css/style.bundle.rtl.css',
    'resources/new_theam/css/dark.rtl.min.css',
    'resources/new_theam/css/dark2.rtl.min.css',
    'resources/new_theam/css/dark3.rtl.min.css',
    'resources/new_theam/css/dark4.rtl.min.css',
], 'public/css/app_2.css');

mix.styles([
    'resources/new_theam/css/test.css',
    'resources/new_theam/css/new-style.css',
], 'public/css/app_3.css');

mix.scripts([
    'resources/new_theam/js/jquery.js',
    'resources/new_theam/js/popper.js',
    'resources/new_theam/js/sweetalert2.min.js',
    'resources/new_theam/js/sweetalert2.init.js',
    'resources/new_theam/js/scripts.bundle.js',
    'resources/new_theam/js/js.cookie.js',
    'resources/new_theam/js/moment.min.js',
    'resources/new_theam/js/tooltip.min.js',
    'resources/new_theam/js/perfect-scrollbar.js',
    'resources/new_theam/js/sticky.min.js',
    'resources/new_theam/js/jquery.form.min.js',
    'resources/new_theam/js/jquery.blockUI.js',
    'resources/new_theam/js/jquery.bootstrap-touchspin.js',
    'resources/new_theam/js/bootstrap-select.js',
    'resources/new_theam/js/bootstrap-switch.js',
    'resources/new_theam/js/bootstrap-switch.init.js',
    'resources/new_theam/js/select2.full.js',
    'resources/new_theam/js/handlebars.js',
    'resources/new_theam/js/jquery-validation.init.js',
    'resources/new_theam/js/toastr.min.js',
    'resources/new_theam/js/morris.js',
], 'public/js/app_2.js');

mix.scripts([
    'resources/new_theam/js/test.js',
    'resources/new_theam/js/dashboard.js',
    'resources/new_theam/js/myjs.js',
    'resources/new_theam/js/bootstrap-datepicker.min.js',
    'resources/new_theam/js/bootstrap-datepicker.init.js',
    'resources/new_theam/js/bootstrap-datetimepicker.min.js',
    'resources/new_theam/js/bootstrap-datepicker.js',
], 'public/js/app_3.js');


mix.styles([
    'resources/visitor/css/bootstrap.min.css',
    'resources/visitor/css/owl.carousel.min.css',
    'resources/visitor/css/magnific-popup.css',
    'resources/visitor/css/font-awesome.min.css',
    'resources/visitor/css/themify-icons.css',
    'resources/visitor/css/nice-select.css',
    'resources/visitor/css/flaticon.css',
    'resources/visitor/css/gijgo.css',
    'resources/visitor/css/animate.css',
    'resources/visitor/css/slicknav.css',
    'resources/visitor/css/style.css',
], 'public/css/app_vis.css');

mix.scripts([
    'resources/visitor/js/vendor/modernizr-3.5.0.min.js',
    'resources/visitor/js/vendor/jquery-1.12.4.min.js',
    'resources/visitor/js/popper.min.js',
    'resources/visitor/js/bootstrap.min.js',
    'resources/visitor/js/owl.carousel.min.js',
    'resources/visitor/js/isotope.pkgd.min.js',
    'resources/visitor/js/ajax-form.js',
    'resources/visitor/js/waypoints.min.js',
    'resources/visitor/js/jquery.counterup.min.js',
    'resources/visitor/js/imagesloaded.pkgd.min.js',
    'resources/visitor/js/scrollIt.js',
    'resources/visitor/js/jquery.scrollUp.min.js',
    'resources/visitor/js/wow.min.js',
    'resources/visitor/js/nice-select.min.js',
    'resources/visitor/js/jquery.slicknav.min.js',
    'resources/visitor/js/jquery.magnific-popup.min.js',
    'resources/visitor/js/plugins.js',
    'resources/visitor/js/js/gijgo.min.js',
    'resources/visitor/js/jquery.ajaxchimp.min.js',
    'resources/visitor/js/jquery.form.js',
    'resources/visitor/js/jquery.validate.min.js',
    'resources/visitor/js/mail-script.js',
    'resources/visitor/js/main.js',
], 'public/js/app_vis.js');

