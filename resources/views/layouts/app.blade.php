<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8'">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('pageTitle','') |
        وقف غزة الخيري</title>
    <meta name="description" content="'">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest'"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/visitor/img/23.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{  asset('visitor/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/animate.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{  asset('visitor/css/style.css')}}">
<!-- <link rel="stylesheet" href="{{  asset('visitor/css/responsive.css')}}"> -->
    @yield('headerCSS')
    @yield('headerJS')
</head>

<body>
@php
    $setting= \App\Setting::find(1);
@endphp
<!-- header-start -->
<header>
    <div class="header-area ">
        <div class="header-top_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-lg-8">
                        <div class="short_contact_list">
                            <ul>
                                <li>
                                    <a href="#"> <i class="fa fa-phone"></i> {{$setting->phone}}</a>
                                </li>
                                <li>
                                    <a href="#"> <i class="fa fa-envelope"></i>{{$setting->email}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-lg-4">
                        <div class="social_media_links d-none d-lg-block">
                            <div class="dropdown show">
                                <a href="/medias"> {{trans('my-word.Media Center')}}</a>
                                <a href="/articles"> {{trans('my-word.News')}}</a>
                                <a href="/contact_us"> {{trans('my-word.Contact Us')}} <span> | </span></a>

                                <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-globe">  {{trans('my-word.Global')}}  </i>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="/en">English</a>
                                    <a class="dropdown-item" href="/ar">العربية</a>
                                    <a class="dropdown-item" href="/tr">Turkish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{asset('/visitor/img/545.PNG')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9">
                        <div class="main-menu">
                            <nav>
                                <ul id="navigation">
                                    <li>
                                        <a href="/about_us">{{trans('my-word.ABOUT US')}}</a>
                                    </li>
                                    @php
                                        $two_categories= \App\P_Category::limit(2)->get();
                                    @endphp
                                    @foreach($two_categories as $category)

                                        <li>
                                            <a href="/p_categories/{{$category->id}}">
                                                @if(config('app.locale')=='en')
                                                    {{$category->name_en}}
                                                @elseif(config('app.locale')=='ar')
                                                    {{$category->name_ar}}
                                                @elseif(config('app.locale')=='tr')
                                                    {{$category->name_tr}}
                                                @endif

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a href="/donations/create">{{trans('my-word.Make a Donate')}} <i
                                                class="fa fa-heart"> </i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
@yield('content')
<!-- footer_start  -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-4 col-lg-4 ">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="#">
                                <img src="{{asset('/visitor/img/23.png')}}" alt="">
                            </a>
                        </div>
                        <p class="address_text ">
                            @if(config('app.locale')=='en')
                                {{$setting->footer_en}}
                            @elseif(config('app.locale')=='ar')
                                {{$setting->footer_ar}}
                            @elseif(config('app.locale')=='tr')
                                {{$setting->footer_tr}}
                            @endif
                        </p>
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="{{$setting->facebook}}">
                                        <i class="ti-facebook fa-2x"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$setting->twitter}}">
                                        <i class="ti-twitter-alt fa-2x"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$setting->youtube}}">
                                        <i class="fa fa-youtube fa-2x"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$setting->instagram}}">
                                        <i class="fa fa-instagram fa-2x"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-lg-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">

                            {{trans('my-word.Services')}}
                        </h3>
                        <ul class="links">
                            <li><a href="/donations/create">{{trans('my-word.Donate')}}</a></li>
                            <li><a href="#">{{trans('my-word.Sponsor')}}</a></li>
                            <li><a href="#">{{trans('my-word.Fundraise')}}</a></li>
                            <li><a href="#">{{trans('my-word.Volunteer')}}</a></li>
                            <li><a href="#">{{trans('my-word.Partner')}}</a></li>
                            <li><a href="#">{{trans('my-word.Jobs')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-lg-4" id="contact_us">
                    <div class="footer_widget">
                        <h3 class="footer_title">

                            {{trans('my-word.Contacts')}}
                        </h3>
                        <div class="contacts">
                            <p>{{$setting->phone}} <br> {{$setting->email}}<br>
                                @if(config('app.locale')=='en')
                                    {{$setting->address_en}}
                                @elseif(config('app.locale')=='ar')
                                    {{$setting->address_ar}}
                                @elseif(config('app.locale')=='tr')
                                    {{$setting->address_tr}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> by
                        <a href="#" target="_blank">MohammedAzzam</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer_end  -->

<!-- JS here -->
<script src="{{  asset('visitor/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{  asset('visitor/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{  asset('visitor/js/popper.min.js')}}"></script>
<script src="{{  asset('visitor/js/bootstrap.min.js')}}"></script>
<script src="{{  asset('visitor/js/owl.carousel.min.js')}}"></script>
<script src="{{  asset('visitor/js/isotope.pkgd.min.js')}}"></script>
<script src="{{  asset('visitor/js/ajax-form.js')}}"></script>
<script src="{{  asset('visitor/js/waypoints.min.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.counterup.min.js')}}"></script>
<script src="{{  asset('visitor/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{  asset('visitor/js/scrollIt.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{  asset('visitor/js/wow.min.js')}}"></script>
<script src="{{  asset('visitor/js/nice-select.min.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.slicknav.min.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{  asset('visitor/js/plugins.js')}}"></script>
<script src="{{  asset('visitor/js/gijgo.min.js')}}"></script>

<!--contact js-->
<script src="{{  asset('visitor/js/contact.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.form.js')}}"></script>
<script src="{{  asset('visitor/js/jquery.validate.min.js')}}"></script>
<script src="{{  asset('visitor/js/mail-script.js')}}"></script>

<script src="{{  asset('visitor/js/main.js')}}"></script>
<script>
    $('.owl-carousel').owlCarousel({
        center: true,
        items: 2,
        autoplay: true,
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
</script>
@yield('footerCSS')
@yield('footerJS')
</body>

</html>