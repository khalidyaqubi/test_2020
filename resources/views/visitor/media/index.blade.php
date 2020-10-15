@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.Media Center')}}
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
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset($setting->media_img)}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="slider_text text-center">
                                            <h3> MEDIA CENTER</h3>
                                            <a href="\">Home > </a>
                                            <a href="\medias"><span>MEDIA CENTER</span></a>
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

    </div>
    <!-- slider_area_end -->

    <br>

    <!-- reson_area_start  -->
    <div class="reson_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span>Media Center</span></h3>
                    </div>
                </div>
            </div>
            @php
                $j=1;
            @endphp
            @foreach($the_dates as $the_date)
                <div @if($j>1) style="display: none" @endif id="{{$j}}" class="not_all section-top-border">
                    <h3 class="mb-30">
                        <a href="/medias/medias_tow?the_date={{$the_date}}">{{Carbon\Carbon::parse($the_date)->format('d F Y')}}</a>
                    </h3>
                    <div class="row owl-carousel owl-theme">
                        @php
                            $the_files=$files->where('the_date',$the_date);

                        @endphp
                        @foreach($the_files as $file)
                            <div class="item">
                                <img src="{{asset($file['path'])}}" style="height: 200px;" alt="" class="img-fluid">
                            </div>
                        @endforeach

                    </div>
                </div>
                @php
                    $j++;
                @endphp
            @endforeach
            <div id="test"></div>
            <div class="all">
                <div class="Appointment text-center">
                    <div class="book_btn d-none d-lg-block">
                        <a href="#{{$j}}" id="more" class="genric-btn success circle arrow ">Show More<span
                                    class="lnr lnr-arrow-right"></span></a></div>
                </div>
            </div>
        </div>
        <!-- reson_area_end  -->
    </div>
    <br>

@endsection

@section('footerCSS')
@endsection

@section('footerJS')
    <script>
        $(document).ready(function () {
            $("#more").click(function () {
                document.querySelectorAll('.not_all[style*="none"]')[0].style.display = 'block';
            });
        });

    </script>

@endsection