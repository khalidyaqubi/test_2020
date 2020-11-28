@php
 $lang = config('app.locale');

 
if(config('app.locale')=='en' || config('app.locale')=='tr'){
$dir = "ltr";
     $js_file = asset('js/app_vis.js');
      $css_file =asset('css/app_vis.css');
      $rOL='left';
                                                
                                            }else{
                      
     $dir = "rtl";
     $js_file = asset('js/app_vis_rtl.js');
       $css_file = asset('css/app_vis_rtl.css');
       $rOL='right';
       
       
                                            }
@endphp
<!doctype html>
<html class="no-js" lang="{{$lang}}" dir="{{$dir}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('pageTitle','') |
        {{trans('my-word.Gaza Charitable Endowment')}}
    </title>
    <meta name="description" content="">
    <meta data-rh="true" name="description" content="وقف غزة ، وقف غزة الخيري، غزة الخيري ، تبرع غزة ، Gaza Endowment Charity ، Gaza Endowment ، Charity Endowment ، donations" data-reactroot=""/>
	
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/visitor/img/23.png')}}">
  
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{$css_file}}">
    <style>
       .owl-carousel{ text-align:-webkit-center}
       span{direction:{{$dir}} !important}
    </style>

  
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    @yield('headerCSS')
    @yield('headerJS')

    @php
        $setting= \App\Setting::find(1);
    @endphp
</head>

<body>

<!-- header-start -->
<header>
    <div class="header-area templatemo-top-bar">
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
                    <div class="col-xl-6 col-md-12  col-lg-8">
                        <div class="social_media_links">
                            <div class="dropdown show">
                                <a href="/medias">{{trans('my-word.Media Center')}}</a>
                                <a href="/articles"> {{trans('my-word.News')}}</a>
                                <a href="/contact_us">  {{trans('my-word.Contact Us')}} <span> | </span></a>

                                <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-globe">    {{trans('my-word.Global')}} </i>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:lang('en')">English</a>
                                    <a class="dropdown-item" href="javascript:lang('ar')">العربية</a>
                                    <a class="dropdown-item" href="javascript:lang('tr')">Turkish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- header-end -->


<div class="header-area " style="
    padding-top: 0;
    background-image: url('{{asset('/img/Footer Background Picture-8.png')}}');
">

    <div id="sticky-header" class="main-header-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <div class="logo">
                        <a href="/" style="
    float:{{$rOL}};
">
                            <img src="{{asset($setting->icon_img)}}" alt="" style="
    width: 100px;
">
                        </a>
                      
                        <a href="/"> <h1 style="
    font-size: 24px;
    color: #3CC78F;
    padding-top: 40px;
    padding-right: 112px;
    padding-left: 112px;
"> {{trans('my-word.Gaza Charitable Endowment')}}</h1></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-3">
                    <div class="main-menu">
                        <div class="Appointment">
                            <div class="book_btn d-none d-lg-block">
                                <a href="/donations/create"> {{trans('my-word.Make a Donate')}} <i
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


<div class="header-area templatemo-second-bar">
    <div class="header-top_area">
        <div class="container-fluid">

        </div>
    </div>
    <div id="sticky-header" class="main-header-area">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-xl-9 col-lg-10 col-sm-10 ">
                    <div class="main-menu">
                        <nav>
                            <ul id="navigation">
                                <li>
                                    <a href="/"> <i class="fa fa-home fa-5x"></i></a>
                                </li>
                                <li>
                                    <a href="/about_us" style="font-weight: 500;
    font-size: 18px;">{{trans('my-word.ABOUT US')}}</a>
                                </li>
                                @php
                                    $two_categories= \App\P_Category::limit(3)->get();
                                @endphp
                                @foreach($two_categories as $category)
                                    <li>
                                        <a class="text-uppercase"
                                        style="font-weight: 500;
    font-size: 18px;"
                                           href="/p_categories/{{$category->id}}">@if(config('app.locale')=='en')
                                                {{$category->name_en}}
                                            @elseif(config('app.locale')=='ar')
                                                {{$category->name_ar}}
                                            @elseif(config('app.locale')=='tr')
                                                {{$category->name_tr}}
                                            @endif</a>
                                    </li>
                                @endforeach

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header-end -->
@yield('content')
<!-- footer_start  -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">

            <div class="row text-center">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <img src="{{asset('/visitor/img/23.png')}}" width="200px">
                </div>

            </div>
            <br>
            <div class="row text-center">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="donate_now_btn text-center">
                        <a href="/contact_us" class="boxed-btn4">{{trans('my-word.Join Us')}}</a>
                    </div>
                </div>

            </div>


            <br>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow bounceInLeft">
                        <div class="social_icons">
                            <ul>
                                <li><a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="{{$setting->twitter}}"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="{{$setting->instagram}}"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li><a href="{{$setting->youtube}}"><i class="fa fa-youtube-play"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="row ">
                <div class="col-xl-5">
                    <p class="copy_right text-center">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved 
                      
                    </p>
                </div>

                <div class="copy_footer col-xl-2 col-lg-3 col-md-3 m-0 " style="font-size: 12px;
    padding: 0;font-weight: bold;">
                    <a href="/contact_us" target="_blank">{{trans('my-word.Contacts')}} |</a>
                     <a href="/about_us" target="_blank">{{trans('my-word.ABOUT US')}} |</a>
                      <a href="/donations/create" target="_blank">{{trans('my-word.Donate')}} </a>
                </div>
                <div class=" col-xl-5 m-0">
                    <p href="#" class="copy_right" target="_blank">{{$setting->phone}} | {{$setting->email}} <br>
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
</footer>
<!-- footer_end  -->

<!-- JS here -->
<script src="{{$js_file}}"></script>

<script src="{{  asset('visitor/js/contact.js')}}"></script>

<script>
for(i=0;i<document.querySelectorAll('.owl-carousel').length;i++){
document.querySelectorAll('.owl-carousel')[i].setAttribute("dir","ltr");
}


    function lang(lang) {
        var url = window.location.href;
        url = url.replace("/ar", "/" + lang);
        url = url.replace("/en", "/" + lang);
        url = url.replace("/tr", "/" + lang);
        window.location.replace(url);
    }
            $(document).ready(function () {
            $('form').submit(function () {
                $(this).find(':submit').attr('disabled', 'disabled');
                $('#wating').show();
            });


        });
    
</script>
@yield('footerJS')
@yield('footerCSS')

</body>

</html>