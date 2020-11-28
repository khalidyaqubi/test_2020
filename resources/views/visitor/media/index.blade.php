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
                                            <h3> {{trans('my-word.Media Center')}}</h3>
                                            <a href="/"> {{trans('my-word.Home')}} </a> >
                                            <a href="/medias"><span>{{trans('my-word.Media Center')}} </span> </a>
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
                        <h3><span>{{trans('my-word.Media Center')}}</span></h3>
                    </div>
                </div>
            </div>
            <div id="medias">
                @foreach($items_1 as $item_1)
                    <div class="section-top-border">
                        <h3 class="mb-30">
                            <a href="\medias\{{$item_1->id}}">
                                {{ \Carbon\Carbon::parse($item_1->created_at)->toFormattedDateString()}}</a>
                        </h3>
                        <div class="row causes_active  owl-carousel owl-theme" style="text-align: center;">
                            @php
                                $items = \App\Media::where('created_at',$item_1->created_at)->where('status',1)->limit(5)->get();
                                ;
                            @endphp
                            @foreach($items as $item)
                                <div class="item">

                                    @if($item->type==1)
                                        <img src="{{asset('size1/'.$item->the_media)}}" alt="" class="img-fluid">
                                    @else
                                        <iframe width="200px" height="149px" src="{{$item->the_media}}">
                                        </iframe>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="Appointment text-center">
                <div class="book_btn d-none d-lg-block">
                    <a  id="next" data-page="2" data-link="/en/medias/medias_ajax?page=" data-div="#medias"
                       class="genric-btn success circle arrow ">Show More<span
                                class="see-more lnr lnr-arrow-right"></span></a></div>
            </div>
        </div>
        <!-- reson_area_end  -->
    </div>
    <br>

@endsection

@section('footerCSS')
<style>
    .owl-carousel .nav-btn{
  height: 47px;
  position: absolute;
  width: 26px;
  cursor: pointer;
  top: 100px !important;
}

.owl-carousel .owl-prev.disabled,
.owl-carousel .owl-next.disabled{
pointer-events: none;
opacity: 0.2;
}

.owl-carousel .prev-slide{
  background: url(nav-icon.png) no-repeat scroll 0 0;
  left: -33px;
}
.owl-carousel .next-slide{
  background: url(nav-icon.png) no-repeat scroll -24px 0px;
  right: -33px;
}
.owl-carousel .prev-slide:hover{
 background-position: 0px -53px;
}
.owl-carousel .next-slide:hover{
background-position: -24px -53px;
}
</style>
@endsection

@section('footerJS')
    <script>
        $('.owl-carousel').owlCarousel({
            center: false,
            items: 2,
            autoplay: false,
            loop: false,
            margin: 10,
            nav: false,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1,
                      nav: true,
	navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                },
                600: {
                    items: 3,
                      nav: true,
	navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                },
                1000: {
                    items: 5,
                      nav: true,
	navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                }
            },
            
        });
     

     
    </script>
    <script>


        function gotoHASH() {
            if (location.hash) {
                if ( $.browser.webkit == false ) {
                    window.location.hash='next';
                } else {
                    window.location.hash='next';
                }
            }
        };
        $('#next').click(function () {
            gotoHASH()
            $div = $($(this).data('div')); //div to append
            $link = $(this).data('link'); //current URL
            $page = $(this).data('page'); //get the next page #
            $href = $link + $page ; //complete URL
            $.get($href, function (response) { //append data
                $div.append(response.html);
            });
            $(this).data('page', (parseInt($page) + 1)); //update page #
            gotoHASH()
        });
    </script>
@endsection