@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.Contact Us')}}
@endsection

@section('headerCSS')
@endsection

@section('headerJS')
@endsection



@section('content')

    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center"
    style="background-image: url({{asset($setting->about_us_img2)}});"
    >
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>{{trans('my-word.Contact')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <div id="map" style="height: 15px;  position: relative; overflow: hidden;"></div>

                <div class="mapouter">
                    <div class="gmap_canvas"><iframe width="950" height="496" id="gmap_canvas" src="https://maps.google.com/maps?q=%D9%81%D9%84%D8%B3%D8%B7%D9%8A%D9%86%20%D8%BA%D8%B2%D8%A9&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://www.whatismyip-address.com">what is my ip</a>
                    </div>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 496px;
                            width: 950px;
                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none!important;
                            height: 496px;
                            width: 950px;
                        }
                    </style>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title" id="contact-title">{{trans('my-word.Get in Touch')}}</h2>
                </div>
                <div class="col-12">
                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show"
                         style="overflow-wrap: anywhere;" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="/contact_us" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="{{trans('my-word.Message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="{{trans('my-word.Enter your name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="mail" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="{{trans('my-word.Email')}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="title" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="{{trans('my-word.Enter Subject')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{trans('my-word.Send Direction')}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{trans('my-word.Address')}}</h3>
                            <p>@if(config('app.locale')=='en')
                                    {{substr($setting->address_en, 0, 100)}}
                                @elseif(config('app.locale')=='tr')
                                    {{substr($setting->address_tr, 0, 100)}}
                                @elseif(config('app.locale')=='ar')
                                    {{substr($setting->address_ar, 0, 100)}};
                                @endif</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{trans('my-word.Phone')}}</h3>
                            <p>{{$setting->phone}}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{$setting->email}}</h3>
                            <p>{{trans('my-word.Send us your query anytime!')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->



@endsection

@section('footerCSS')
@endsection

@section('footerJS')
@endsection