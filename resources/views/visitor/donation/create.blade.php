@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.DONATE NOW')}}
@endsection

@section('headerCSS')
    <style>
        div label input {
            margin-right: 100px;
        }

        body {
            font-family: sans-serif;
        }

        .ck-button {
            margin: 4px;
            border: 1px solid #3CC78F;
            overflow: auto;
            float: left;
        }

        .ck-button label {
            float: left;
            width: 4.0em;
        }

        .ck-button label span {
            text-align: center;
            padding: 3px 0px;
            display: block;
        }

        .ck-button label input {
            position: absolute;
            top: -20px;
        }

        .ck-button input:checked + span {
            background-color: #3CC78F;
            color: #fff;
        }
    </style>
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
                <img class="d-block w-100" src="{{asset($setting->donate_img)}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="slider_text text-center">
                                            <h3> {{trans('my-word.DONATE NOW')}}</h3>
                                            <a href=""><span>{{trans('my-word.YOURE GET WILL HELP SAVE LIVE')}}</span></a>
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

    <!--Make_donet_Start-->
    <form action="{{url('paypal/ec-checkout')}}" method="get">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h5>    <?php if(!empty($response['code'])) { ?>
                            <div class="alert alert-<?php echo $response['code']; ?>">
                                <?php echo $response['message']; ?>
                            </div>
                            <?php } ?></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span> {{trans('my-word.1- I Would Like To Make A')}}</span></h3>
                    </div>
                </div>

            </div>


            <div class="row text">
                <div class="ck-button col-lg">
                    <label>
                        <input type="radio" name="is_monthly" value="1">
                        <span class="btn btn-sm animated-button victoria-four"
                              style="font-size: revert;font-weight: bold">{{trans('my-word.MONTHLY DONATION')}}</span>
                    </label>
                </div>
                <div class="ck-button col-lg">
                    <label>
                        <input type="radio" name="is_monthly" value="0">
                        <span class="btn btn-sm animated-button victoria-four"
                              style="font-size: revert;font-weight: bold">{{trans('my-word.ONE-OFF DONATION')}}</span>
                    </label>
                </div>
            </div>
            <hr>
            <br>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span>{{trans('my-word.2- Select Project For  Donation')}} </span></h3>
                    </div>
                </div>
            </div>

            @foreach($p_categories->chunk(2) as $p_categories2)
                <div class="row text">
                    @foreach($p_categories2 as $p_category)
                        <div class="ck-button col-lg">
                            <label>
                                <input type="radio" name="p_category_id" value="{{$p_category->id}}">
                                <span class="btn btn-sm animated-button victoria-four"
                                      style="font-size: revert;font-weight: bold">
                                    @if(config('app.locale')=='en')
                                        {{$p_category->name_en}}
                                    @elseif(config('app.locale')=='tr')
                                        {{$p_category->name_tr}}
                                    @elseif(config('app.locale')=='ar')
                                        {{$p_category->name_ar}};
                                    @endif </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <br>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center">
                        <h4><span> {{trans('my-word.How much would you like to give?')}} </span></h4>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-3 col-sm-5 col-xs-4 "><a href="#the_price"
                                                            class="btn btn-sm animated-button victoria-one"
                                                            onclick="javascript:document.getElementById('price').value=20">$20</a>
                </div>
                <div class="col-md-3 col-sm-5 col-xs-4 "><a href="#the_price"
                                                            class="btn btn-sm animated-button victoria-one"
                                                            onclick="javascript:document.getElementById('price').value=50">$50</a>
                </div>
                <div class="col-md-3 col-sm-5 col-xs-4 "><a href="#the_price"
                                                            class="btn btn-sm animated-button victoria-one"
                                                            onclick="javascript:document.getElementById('price').value=100">$100</a>
                </div>
                <div class="col-md-3 col-sm-5 col-xs-4 "><a href="#the_price"
                                                            class="btn btn-sm animated-button victoria-one"
                                                            onclick="javascript:document.getElementById('price').value=0">{{trans('my-word.others')}}</a>
                </div>
            </div>
            <div data-scroll-index='1' class="make_donation_area section_padding">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <form action="#" class="donation_form">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="single_amount">
                                            <div class="input_field">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span slicknav_iconan class="input-group-text"
                                                          id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="number" name="amount" id="price" class="form-control"
                                                           placeholder="$0,000"
                                                           aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="donate_now_btn text-center">
                                <button type="submit" href="#"
                                        class="boxed-btn4">{{trans('my-word.DONATE NOW')}}</button>
                            </div>
                        </div>
                        <div class="text-center" style="margin: auto;padding-top: 20px;">
                            <i class="fa fa-lock fa-2x"></i>
                            <h6>{{trans('my-word.Secuere Donating With Worldpay')}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <hr>


        </div>
        <!--Make_donet_End-->
    </form>


@endsection

@section('footerCSS')
@endsection

@section('footerJS')


@endsection