@extends('layouts.app')

@section('pageTitle')

    @if(config('app.locale')=='en')
        {{substr($project->title_en, 0, 6)}}
    @elseif(config('app.locale')=='tr')
        {{substr($project->title_tr, 0, 6)}}
    @elseif(config('app.locale')=='ar')
        {{substr($project->title_ar, 0, 6)}};
    @endif

@endsection

@section('headerCSS')


@endsection

@section('headerJS')
@endsection



@section('content')
    <!-- ***** Top Feature Area Start ***** -->
    <div class="fancy-top-features-area bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fancy-top-features-content">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset("size5/".$project->img)}}"
                                                 alt="First slide">
                                        </div>

                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    <div class="container pt-4 pb-5">
                                        <div class="row carousel-indicators">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="comments-area text-center">
                                    <p class="comment text-center">
                                        @if(config('app.locale')=='en')
                                            {{$project->p_categories->first()->name_en}}
                                        @elseif(config('app.locale')=='tr')
                                            {{$project->p_categories->first()->name_tr}}
                                        @elseif(config('app.locale')=='ar')
                                            {{$project->p_categories->first()->name_ar}};
                                        @endif
                                    </p>
                                    <h4>@if(config('app.locale')=='en')
                                            {{$project->title_en}}
                                        @elseif(config('app.locale')=='tr')
                                            {{$project->title_tr}}
                                        @elseif(config('app.locale')=='ar')
                                            {{$project->title_ar}};
                                        @endif</h4>
                                    <div class="comment-list">
                                        <div class="user justify-content-between d-flex">
                                            <div class="desc">
                                                <p class="comment">

                                                    @if(config('app.locale')=='en')
                                                        {{substr($project->details_en, 0, 300)}}
                                                    @elseif(config('app.locale')=='tr')
                                                        {{substr($project->details_tr, 0, 300)}}
                                                    @elseif(config('app.locale')=='ar')
                                                        {{substr($project->details_ar, 0, 300)}};
                                                    @endif
                                                </p>

                                                <div class="causes_content ml-3">
                                                    <div class="custom_progress_bar">
                                                        <div class="balance d-flex justify-content-between align-items-center">
                                                            <span> {{$project->come_amount}} $  USD</span>
                                                            <span>{{ ($project->come_amount/$project->need_amount)*100 }} %</span>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width:{{ ($project->come_amount/$project->need_amount)*100 }} %;"
                                                                 aria-valuenow="{{ ($project->come_amount/$project->need_amount)*100 }}" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                <span class="progres_count">
                                                                    {{ ($project->come_amount/$project->need_amount)*100 }} %
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <br>
                                                <div>
                                                    <a href="/projects/{{$project->id}}/donations"
                                                       class="boxed-btn4 ">{{trans('my-word.DONATE NOW')}}</a>
                                                </div>

                                                <br>
                                                <div class="social_links">
                                                    <div class="social-icons">

                                                        <a href="{{$setting->twitter}}"
                                                           class="social-icon social-icon--twitter">
                                                            <i class="fa fa-twitter fa-2x"></i>
                                                        </a>

                                                        <a href="{{$setting->instagram}}"
                                                           class="social-icon social-icon--instagram">
                                                            <i class="fa fa-instagram fa-2x"></i>
                                                        </a>
                                                        <a href="{{$setting->youtube}}"
                                                           class="social-icon social-icon--youtube">
                                                            <i class="fa fa-linkedin fa-2x"></i>
                                                        </a>

                                                        <a href="{{$setting->facebook}}"
                                                           class="social-icon social-icon--facebook">
                                                            <i class="fa fa-facebook fa-2x"></i>
                                                        </a>
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
        </div>
    </div>
    <!-- ***** Top Feature Area End ***** -->




    <!-- _start  -->
    <div class="popular_causes_area pt-120 cause_details ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="single_cause">

                        <div class="causes_content">

                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="section_title text-center mb-55">
                                        <h3><span>@if(config('app.locale')=='en')
                                                    {{$project->title_en}}
                                                @elseif(config('app.locale')=='tr')
                                                    {{$project->title_tr}}
                                                @elseif(config('app.locale')=='ar')
                                                    {{$project->title_ar}};
                                                @endif</span></h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center">
                                @if(config('app.locale')=='en')
                                    {{$project->details_en}}
                                @elseif(config('app.locale')=='tr')
                                    {{$project->details_tr}}
                                @elseif(config('app.locale')=='ar')
                                    {{$project->details_ar}};
                                @endif

                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- _end  -->


    <!--Tag Start-->
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-lg-6">
                <h3><span>{{trans('my-word.Tags For This Project')}}</span></h3>
            </div>
            @foreach($project->p_categories as $category)
                <div class="book_btn d-none d-lg-block">
                    <a href="/p_categories/{{$category->id}}"
                       class="genric-btn success circle arrow ">@if(config('app.locale')=='en')
                            {{$category->name_en}}
                        @elseif(config('app.locale')=='ar')
                            {{$category->name_ar}}
                        @elseif(config('app.locale')=='tr')
                            {{$category->name_tr}}
                        @endif</a>
                </div>
            @endforeach

        </div>
    </div>
    <!--Tag Start-->

    <!-- popular_causes_area_start  -->
    <div class="popular_causes_area section_padding">
        <div class="container">
            <div class="row justify-content-left">
                <div class="col-lg-12">
                    <h3><span>{{trans('my-word.You Many also be interested in')}}</span></h3>
                </div>
                <br>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="causes_active owl-carousel">
                        @foreach($projects_related as $project)
                            <div class="single_cause">
                                <div class="thumb">
                                    <img src="{{asset("size6/".$project->img)}}" alt="">
                                </div>
                                <div class="causes_content">
                                    <div class="custom_progress_bar">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width: {{ ($project->come_amount/$project->need_amount)*100 }}%;"
                                                 aria-valuenow="{{ ($project->come_amount/$project->need_amount)*100 }}"
                                                 aria-valuemin="0" aria-valuemax="100">
                                            <span class="progres_count">
                                                    {{ ($project->come_amount/$project->need_amount)*100 }} %
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="balance d-flex justify-content-between align-items-center">
                                        <span>{{trans('my-word.Raised')}}: {{$project->come_amount}} $</span>
                                        <span>{{trans('my-word.Goal')}}: {{$project->need_amount}} $ </span>
                                    </div>
                                    <a href="/projects/{{$project->id}}"><h4>@if(config('app.locale')=='en')
                                                {{substr($project->title_en, 0, 100)}}
                                            @elseif(config('app.locale')=='tr')
                                                {{substr($project->title_tr, 0, 100)}}
                                            @elseif(config('app.locale')=='ar')
                                                {{substr($project->title_ar, 0, 100)}};
                                            @endif</h4></a>
                                    <p>@if(config('app.locale')=='en')
                                            {{substr($project->details_en, 0, 300)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{substr($project->details_tr, 0, 300)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{substr($project->details_ar, 0, 300)}};
                                        @endif</p>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popular_causes_area_end  -->



@endsection

@section('footerCSS')
@endsection

@section('footerJS')


@endsection