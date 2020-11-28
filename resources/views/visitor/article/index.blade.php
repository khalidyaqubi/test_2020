@extends('layouts.app')

@section('pageTitle')
   {{trans('my-word.News')}}
@endsection

@section('headerCSS')

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
                     <a href="{{ url('/articles'.'/'.$article->id) }}">   <img src= "{{asset('size2/'.$article->img)}}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="col-md-9 mt-sm-20">
                        <a href="{{ url('/articles'.'/'.$article->id) }}">
                            {{-- <h3 class="mb-30">{{ $article->created_at->format('d/m/y') }}</h3> --}}
                            <h3 class="mb-30">{{ \Carbon\Carbon::parse($article->created_at)->toFormattedDateString()}} </h3>
                        </a>
                        <h5>
                            @if(config('app.locale')=='en')
                            {{mb_substr($article->details_en, 0, 300)}}
                        @elseif(config('app.locale')=='tr')
                            {{mb_substr($article->details_tr, 0, 300)}}
                        @elseif(config('app.locale')=='ar')
                            {{mb_substr($article->details_ar, 0, 300)}}
                        @endif
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
           


            {{--<nav class="blog-pagination justify-content-center d-flex">--}}
                {{--<ul class="pagination">--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link" aria-label="Previous">--}}
                            {{--<i class="ti-angle-left"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link">1</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item active">--}}
                        {{--<a href="#" class="page-link">2</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link">3</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link">4</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link">.....</a>--}}
                    {{--</li>--}}
                    {{--<li class="page-item">--}}
                        {{--<a href="#" class="page-link" aria-label="Next">--}}
                            {{--<i class="ti-angle-right"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</nav>--}}
                {{$items->links()}}
        </div>
    </div>
    <!-- End Align Area -->

    <br>



  

@endsection

@section('footerCSS')
@endsection

@section('footerJS')
@endsection