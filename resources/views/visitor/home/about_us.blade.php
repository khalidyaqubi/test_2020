@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.ABOUT US')}}
@endsection

@section('headerCSS')
@endsection

@section('headerJS')
@endsection



@section('content')
    <!-- slider_area_start -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img class="d-block w-100" src="{{asset($setting->about_us_img)}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_text text-center">
                                            <h3> {{trans('my-word.ABOUT')}}</h3>
                                            <a href="\">{{trans('my-word.Home')}} > </a>
                                            <a href="\about_us"><span>{{trans('my-word.ABOUT')}}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- slider_area_end -->
    <br>
    <!-- ***** Top Feature Area Start ***** -->
    <div class="fancy-top-features-area bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fancy-top-features-content">
                        <div class="row no-gutters">
                            <div class="col-8 col-md-8">
                                <div class="single-top-feature">
                                    <h3><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                        {{trans('my-word.About Gaza Endowment Charity')}}
                                        </h3>
                                    <p>
                                        @if(config('app.locale')=='en')
                                            {{substr($setting->who_are_we_en, 0, 300)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{substr($setting->who_are_we_tr, 0, 300)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{substr($setting->who_are_we_ar, 0, 300)}};
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="text-right p-3">
                                    <div class="form-group">
                                        <button class="btn btn-primary">{{trans('my-word.Watch our video')}} <i class="fa fa-arrow-down">  </i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Top Feature Area End ***** -->
    <br>
    <!--*****Our work Start*****-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="timeline-centered">

                    <article class="timeline-entry animate-box" data-animate-effect="fadeInLeft">
                        <div class="timeline-entry-inner">

                            <div class="timeline-label">
                                <h2>{{trans('my-word.Our work in action')}}</h2>
                                <p>
                                    @if(config('app.locale')=='en')
                                        {{substr($setting->our_active_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($setting->our_active_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($setting->our_active_ar, 0, 300)}};
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>


                </div>
            </div>
        </div>
    </div>
    <!--*****Our work End*****-->
    <!-- ***** Video Start ***** -->
    <div class="container text-center">
        <iframe width="1000" height="500" src="{{$setting->about_us_video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
    </div>

    <!-- ***** Video End ***** -->
    <!--*****Our work Start*****-->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="timeline-centered">

                    <article class="timeline-entry animate-box" data-animate-effect="fadeInLeft">
                        <div class="timeline-entry-inner">

                            <div class="timeline-label">
                                <h2>{{trans('my-word.Our Mission')}}</h2>
                                <p>
                                    @if(config('app.locale')=='en')
                                        {{substr($setting->our_mission_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($setting->our_mission_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($setting->our_mission_ar, 0, 300)}};
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>


                </div>
            </div>

            <div class="col-md-6">
                <div class="timeline-centered">

                    <article class="timeline-entry animate-box" data-animate-effect="fadeInLeft">
                        <div class="timeline-entry-inner">

                            <div class="timeline-label">
                                <h2>{{trans('my-word.Our Objective')}}</h2>
                                <p>
                                    @if(config('app.locale')=='en')
                                        {{substr($setting->our_object_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($setting->our_object_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($setting->our_object_ar, 0, 300)}};
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>


                </div>
            </div>
        </div>
    </div>
    <!--*****Our work End*****-->


@endsection

@section('footerCSS')
@endsection

@section('footerJS')
@endsection