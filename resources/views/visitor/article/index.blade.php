@extends('layouts.app')

@section('pageTitle')
   {{trans('my-word.News')}}
@endsection

@section('headerCSS')
<link rel="shortcut icon" type="image/x-icon" href="">

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

    <!-- slider_area_start -->
    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src={{ asset("img/Image.png") }} alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_text text-center">
                                            <h3> NEWS</h3>
                                            <a href="">Home > </a>
                                            <a href=""><span>NEWS</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>

    </div> --}}
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center"
    style="background-image: url({{asset($setting->about_us_img2)}});"
    >
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{trans('my-word.News')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <br>


    <div class="whole-wrap">
        <div class="container box_1170">
            @foreach ($items as $article)
            <div class="section-top-border">
               
                <div class="row">
                    <div class="col-md-3">
                        <img src= "{{asset('size2/'.$article->img)}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-9 mt-sm-20">
                        <a href="{{ url('/articles'.'/'.$article->id) }}">
                            {{-- <h3 class="mb-30">{{ $article->created_at->format('d/m/y') }}</h3> --}}
                            <h3 class="mb-30">{{ \Carbon\Carbon::parse($article->created_at)->toFormattedDateString()}} </h3>
                        </a>
                        <h5>
                            @if(config('app.locale')=='en')
                            {{substr($article->details_en, 0, 300)}}
                        @elseif(config('app.locale')=='tr')
                            {{substr($article->details_tr, 0, 300)}}
                        @elseif(config('app.locale')=='ar')
                            {{substr($article->details_ar, 0, 300)}};
                        @endif
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
           


            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="#" class="page-link" aria-label="Previous">
                            <i class="ti-angle-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item active">
                        <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">.....</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link" aria-label="Next">
                            <i class="ti-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- End Align Area -->

    <br>



  

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