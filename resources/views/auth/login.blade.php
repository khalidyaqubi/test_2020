<!DOCTYPE html>
<html lang="ar" direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>وقف غزة الخيري - تسجيل دخول</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link rel="stylesheet" href="{{asset('new_theme/assets/css/pages/login/login-3.css')}}"/>

    <!--begin::Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{asset('new_theme/assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/socicon/css/socicon.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/plugins/line-awesome/css/line-awesome.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/plugins/flaticon/flaticon.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/plugins/flaticon2/flaticon.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/plugins/general/select2/dist/css/select2.css')}}" rel="stylesheet"
          type="text/css"/>


    <!--end:: Vendor Plugins -->
    <link href="{{asset('new_theme/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{asset('new_theme/assets/css/skins/header/base/dark.rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/css/skins/header/menu/dark.rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/css/skins/brand/dark.rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/css/skins/aside/dark.rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('new_theme/assets/css/new-style.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset('new_theme/assets/media/logo-icon.png')}}"/>
    <style>
        .kt-checkbox > span:after {
    border: solid #5d78ff;
}
.kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-form .kt-login__extra .kt-login__link {
    font-size: 1rem;
    color: #5d78ff;
    -webkit-transition: color 0.3s ease;
    transition: color 0.3s ease;
    /* text-decoration-color: red; */
    text-decoration: solid;
    text-decoration-line: underline;
    text-decoration-skip-ink: none;
}
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
             style="background-image: url({{asset('new_theme/assets/media/bg/bg-3.jpg')}});">


            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" style="padding-top: 10px">
                <div class="kt-login__container">
                    <div class="kt-login__logo mb-3">
                        <a href="/">

                                <img src="{{asset('/visitor/img/23.png')}}" width="200px" height="200px" alt="logo"/>

                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head" style="margin: 0">
                            <h3 class="kt-login__title">مرحبا في بكم في موقع وقف غزة الخير</h3>
                            <h3 class="kt-login__desc mt-1">تسجيل دخول</h3>
                        </div>
                        @if (session('warning'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('warning') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="kt-form" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="email" placeholder=" البريد الالكتروني" name="email"
                                       autocomplete="off" value="{{old('email')}}"
                                       style="background-color:#ddd8e5"
                                >
                            </div>
                            <div class="input-group">
                                <input class="form-control"  style="background-color:#ddd8e5" type="password" placeholder="كلمة المرور" name="password">
                            </div>
                        
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember"> تذكرني
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    <a href="{{ route('password.request') }}" id="kt_login_forgot"
                                       class="kt-login__link">هل نسيت
                                        كلمة المرور ؟</a>
                                </div>
                            </div>

                            <div class="kt-login__actions mt-1">
                                <button id="kt_login_signin_submit"
                                        class="btn btn-brand btn-elevate kt-login__btn-primary">تسجيل دخول
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->


<!--begin::Global Theme Bundle(used by all pages) -->
<!--begin:: Vendor Plugins -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{asset('new_theme/assets/plugins/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/popper.js/dist/umd/popper.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap/dist/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/sticky-js/dist/sticky.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/jquery-form/dist/jquery.form.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/select2/dist/js/select2.full.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/handlebars/dist/handlebars.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/morris.js/morris.js')}}" type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/sweetalert2/dist/sweetalert2.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('new_theme/assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js')}}"
        type="text/javascript"></script>

<!--end:: Vendor Plugins -->
<script src="{{asset('new_theme/assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('new_theme/assets/js/pages/dashboard.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
