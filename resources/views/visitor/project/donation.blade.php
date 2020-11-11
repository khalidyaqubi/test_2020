@extends('layouts.app')

@section('pageTitle')

    @if(config('app.locale')=='en')
        {{substr($project->title_en, 0, 6)}}
    @elseif(config('app.locale')=='tr')
        {{substr($project->title_tr, 0, 6)}}
    @elseif(config('app.locale')=='ar')
        {{substr($project->title_ar, 0, 6)}};
    @endif
    {{trans('my-word.Donate')}}
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

    <div class="container">
        <div class="section-top-border text-right ">

            <div class="row">
                <div class="col-md-9 text-left">
                    <h4>  {{trans('my-word.Make a Donate')}} @if(config('app.locale')=='en')
                            {{$project->p_categories->first()->name_en}}
                        @elseif(config('app.locale')=='tr')
                            {{$project->p_categories->first()->name_tr}}
                        @elseif(config('app.locale')=='ar')
                            {{$project->p_categories->first()->name_ar}};
                        @endif </h4>
                    <br>
                    <h2>@if(config('app.locale')=='en')
                            {{$project->title_en}}
                        @elseif(config('app.locale')=='tr')
                            {{$project->title_tr}}
                        @elseif(config('app.locale')=='ar')
                            {{$project->title_ar}};
                        @endif</h2>
                    <h5>    <?php if(!empty($response['code'])) { ?>
                        <div class="alert alert-<?php echo $response['code']; ?>">
                            <?php echo $response['message']; ?>
                        </div>
                        <?php } ?></h5>

                </div>
                <div class="col-md-3">
                    <img src="{{asset("size3/".$project->img)}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- Make Donite-end -->

    <hr>

    <!--Make_donet_Start-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center mb-55">
                    <h3><span>{{trans('my-word.1- I Would Like To Make A')}} </span></h3>
                </div>
            </div>
        </div>

        <form action="{{url('paypal/ec-checkout')}}" method="get">
            @csrf
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
                    <div class="section_title text-center" id="the_price">
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
                                                    <input type="hidden" name="project_id" value="{{$project->id}}">
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
        </form>
        <br>
        <hr>

    </div>
    <!--Make_donet_End-->



@endsection

@section('footerCSS')
@endsection

@section('footerJS')

    <script>

    </script>

@endsection