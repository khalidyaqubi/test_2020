@extends('layouts.app')

@section('pageTitle')

@if(config('app.locale')=='en')
{{substr($article->title_en, 0, 6)}}
@elseif(config('app.locale')=='tr')
{{substr($article->title_tr, 0, 6)}}
@elseif(config('app.locale')=='ar')
{{substr($article->title_ar, 0, 6)}};
@endif

@endsection

@section('headerCSS')
<!-- <link rel="manifest" href="site.webmanifest"> -->
<link rel="shortcut icon" type="image/x-icon" href="">
<!-- Place favicon.ico in the root directory -->

<!-- CSS here -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/themify-icons.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/gijgo.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/slicknav.css">
<link rel="stylesheet" href="css/style.css">

@endsection

@section('headerJS')
@endsection



@section('content')




    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            
                                <h6>{{ \Carbon\Carbon::parse($article->created_at)->toFormattedDateString()}} 
                                </h6>
                            <h2 class="mb-30">
                                
                            @if(config('app.locale')=='en')
                                    {{substr($article->title_en, 0, 100)}}
                                @elseif(config('app.locale')=='tr')
                                    {{substr($article->title_tr, 0, 100)}}
                                @elseif(config('app.locale')=='ar')
                                    {{substr($article->title_ar, 0, 100)}};
                                @endif
                            
                            </h2>
                            <div class="blog_item_img">
                                <img  class="card-img rounded-0" src="{{asset("size3/".$article->img)}}" alt="">
                            </div>

                            <div class="blog_details">
                               
                            <h2>       
                            @if(config('app.locale')=='en')
                            {{substr($article->details_en, 0, 300)}}
                            @elseif(config('app.locale')=='tr')
                                {{substr($article->details_tr, 0, 300)}}
                            @elseif(config('app.locale')=='ar')
                                {{substr($article->details_ar, 0, 300)}};
                            @endif
                         </h2> 
                                
                             <h6>
                                @if(config('app.locale')=='en')
                                  {{strip_tags($article->the_file_en)}}
                                @elseif(config('app.locale')=='tr')
                                    {{strip_tags($article->the_file_tr)}}
                                @elseif(config('app.locale')=='ar')
                                    {{strip_tags($article->the_file_ar)}};
                                @endif
                            </h6>     
                            </div>
                        </article>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

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


                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">{{trans('my-word.Recent Post')}} </h3>
                           @foreach ($articles as $item)
                          
                           <div class="media post_item">
                            <img src="{{asset("size4/".$item->img)}}" alt="post">
                            <div class="media-body">
                                <h3> 
                                    @if(config('app.locale')=='en')
                                    {{substr($item->title_en, 0, 100)}}
                                @elseif(config('app.locale')=='tr')
                                    {{substr($item->title_tr, 0, 100)}}
                                @elseif(config('app.locale')=='ar')
                                    {{substr($item->title_ar, 0, 100)}};
                                @endif
                                </h3>
                                    <h6>{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString()}} 
                                    </h6>
                             </div>
                             </div>
                           @endforeach
                           
                        
                        </aside>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@endsection

@section('footerCSS')
@endsection

@section('footerJS')


    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>
    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>

@endsection