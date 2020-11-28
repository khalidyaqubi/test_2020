@extends('layouts.app')

@section('pageTitle')

    @if(config('app.locale')=='en')
        {{mb_substr($article->title_en, 0, 16)}}
    @elseif(config('app.locale')=='tr')
        {{mb_substr($article->title_tr, 0, 16)}}
    @elseif(config('app.locale')=='ar')
        {{mb_substr($article->title_ar, 0, 16)}}
    @endif

@endsection

@section('headerCSS')


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
                                    {{$article->title_en}}
                                @elseif(config('app.locale')=='tr')
                                    {{$article->title_tr}}
                                @elseif(config('app.locale')=='ar')
                                    {{$article->title_ar}}
                                @endif

                            </h2>
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset("size7/".$article->img)}}" alt="">
                            </div>

                            <div class="blog_details">

                                <h2>
                                    @if(config('app.locale')=='en')
                                        {{$article->details_en}}
                                    @elseif(config('app.locale')=='tr')
                                        {{$article->details_tr}}
                                    @elseif(config('app.locale')=='ar')
                                        {{$article->details_ar}}
                                    @endif
                                </h2>

                                <h6>
                                    @if(config('app.locale')=='en')
                                        {!!$article->the_file_en!!}
                                    @elseif(config('app.locale')=='tr')
                                        {!!$article->the_file_tr!!}
                                    @elseif(config('app.locale')=='ar')
                                        {!!$article->the_file_ar!!}
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


                        <aside class="single_sidebar_widget popular_post_widget"style="
    margin: 5px;
">
                            <h3 class="widget_title">{{trans('my-word.Recent Post')}} </h3>
                            @foreach ($articles as $item)

                                <div class="media post_item">
                                    <a href="{{ url('/articles'.'/'.$item->id) }}"><img
                                                src="{{asset("size4/".$item->img)}}" alt="post"></a>
                                    <div class="media-body">
                                        <a href="{{ url('/articles'.'/'.$item->id) }}">
                                            <h3>
                                                @if(config('app.locale')=='en')
                                                    {{mb_substr($item->title_en, 0, 100)}}
                                                @elseif(config('app.locale')=='tr')
                                                    {{mb_substr($item->title_tr, 0, 100)}}
                                                @elseif(config('app.locale')=='ar')
                                                    {{mb_substr($item->title_ar, 0, 100)}}
                                                @endif
                                            </h3>
                                        </a>
                                        <h6>{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString()}}
                                        </h6>
                                    </div>
                                </div>
                            @endforeach


                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget"style="
    margin: 5px;
">
                            <h3 class="widget_title">{{trans('my-word.Related Post')}} </h3>
                            @foreach ($articles_related as $item)

                                <div class="media post_item">
                                    <a href="{{ url('/articles'.'/'.$item->id) }}"> <img
                                                src="{{asset("size4/".$item->img)}}" alt="post">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ url('/articles'.'/'.$item->id) }}"><h3>
                                                @if(config('app.locale')=='en')
                                                    {{mb_substr($item->title_en, 0, 100)}}
                                                @elseif(config('app.locale')=='tr')
                                                    {{mb_substr($item->title_tr, 0, 100)}}
                                                @elseif(config('app.locale')=='ar')
                                                    {{mb_substr($item->title_ar, 0, 100)}}
                                                @endif
                                            </h3></a>
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
    <style>
        .blog_details p{
         color:#000;
        }
    </style>
@endsection

@section('footerJS')


@endsection