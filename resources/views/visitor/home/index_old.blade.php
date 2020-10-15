@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.Home')}}
@endsection

@section('headerCSS')
@endsection

@section('headerJS')
@endsection



@section('content')

    <!-- Video Start-->
    <section>
        <div class="video-header">

            <iframe width="100%" height="100%"
                    src={{$setting->main_video."?autoplay=0&controls=0"}}>
            </iframe>
        </div>
    </section>
    <!-- Video End-->


    <!-- reson_area_start  -->
    <div class="reson_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <a href="\articles"><h3><span>{{trans('my-word.News')}}</span></h3></a>
                    </div>
                </div>
            </div>
            @if($fixed_article)
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-6 col-md-8">
                        <div class="single_reson">
                            <div class="thum">
                                <div class="thum_1">
                                    <img src="{{asset("size2/".$fixed_article->img)}}" alt="">
                                </div>
                            </div>
                            <div class="help_content">
                                <h3>
                                    @if(config('app.locale')=='en')
                                        {{substr($fixed_article->title_en, 0, 100)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($fixed_article->title_tr, 0, 100)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($fixed_article->title_ar, 0, 100)}};
                                    @endif
                                </h3>
                                <h6>
                                    @if(config('app.locale')=='en')
                                        {{substr($fixed_article->details_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($fixed_article->details_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($fixed_article->details_ar, 0, 300)}};
                                    @endif
                                </h6><a href="/articles/{{$fixed_article->id}}" class="read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center mb-5">
                @foreach($last_6_articles as $article)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="single_reson">
                            <div class="thum">
                                <div class="thum_1">
                                    <img src="{{asset("size1/".$article->img)}}" alt="">
                                </div>
                            </div>
                            <div class="help_content">
                                <h3>@if(config('app.locale')=='en')
                                        {{substr($article->title_en, 0, 100)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($article->title_tr, 0, 100)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($article->title_ar, 0, 100)}};
                                    @endif</h3>
                                <h6>
                                    @if(config('app.locale')=='en')
                                        {{substr($article->details_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($article->details_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($article->details_ar, 0, 300)}};
                                    @endif
                                </h6>
                                <a href="/articles/{{$article->id}}" class="read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- reson_area_end  -->


    <!-- counter_area_start  -->
    <div class="counter_area pt-120">
        <div class="container">
            <div class="counter_bg overlay">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{$project_funded}}</h3>
                                <p>{{trans('my-word.Project Funded')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-heart-beat"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{$international_contributors}}</h3>
                                <p>{{trans('my-word.International Contributors')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-in-love"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{$total_raised}}</h3>
                                <p>{{trans('my-word.Total Raised')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-hug"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">98%</h3>
                                <p>{{trans('my-word.Satisfaction Rating')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter_area_end  -->

    <br>

    <!-- latest_activites_area_start  -->
    <div class="latest_activites_area">
        <div class=" video_bg_1 video_activite  d-flex align-items-center justify-content-center"
        style="background-image: url({{asset("size2/".$fixed_project->img)}});">

        </div>
        <div class="container">
            @if($fixed_project)
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="activites_info">
                            <div class="section_title">
                                <h3>
                                    @if(config('app.locale')=='en')
                                        {{substr($fixed_project->title_en, 0, 100)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{substr($fixed_project->title_tr, 0, 100)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{substr($fixed_project->title_ar, 0, 100)}};
                                    @endif

                                    <br>
                                        {{trans('my-word.Need Our Help')}}
                                </h3>
                            </div>
                            <p class="para_1">
                                @if(config('app.locale')=='en')
                                    {{substr($fixed_project->details_en, 0, 300)}}
                                @elseif(config('app.locale')=='tr')
                                    {{substr($fixed_project->details_tr, 0, 300)}}
                                @elseif(config('app.locale')=='ar')
                                    {{substr($fixed_project->details_ar, 0, 300)}};
                                @endif

                            </p>
                            <a href="projects/{{$fixed_project->id}}/donations" data-scroll-nav="1" class="boxed-btn4">Donate
                                Now</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- latest_activites_area_end  -->


    <!-- popular_causes_area_start  -->
    <div class="popular_causes_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <a href="\projects"><h3><span>{{trans('my-word.Popular Project')}}</span></h3></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="causes_active owl-carousel">
                        @foreach($last_6_projects as $project)
                            <div class="single_cause">
                                <div class="thumb">
                                    <img src="{{asset("size1/".$project->img)}}" alt="">
                                </div>
                                <div class="causes_content">
                                    <div class="custom_progress_bar">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 30%;"
                                                 aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                            <span class="progres_count">
                                                   {{ ($project->come_amount/$project->need_amount)*100 }} %
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="balance d-flex justify-content-between align-items-center">
                                        <span>Raised: {{$project->come_amount}} $ </span>
                                        <span>Goal: {{$project->need_amount}} $ </span>
                                    </div>
                                    <h4>@if(config('app.locale')=='en')
                                            {{substr($project->title_en, 0, 100)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{substr($project->title_tr, 0, 100)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{substr($project->title_ar, 0, 100)}};
                                        @endif</h4>
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


    <!--Our Media Start-->
    <div class="site-blocks-cover overlay inner-page-cover" style="background-image: url({{ asset($setting->media_img) }});"
         data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="/medias/medias_tow"><h1 class="text-white">{{trans('my-word.Our Media')}}</h1></a>
                </div>
            </div>
        </div>
    </div>
    <!--Our Media End-->

@endsection

@section('footerCSS')
@endsection

@section('footerJS')
@endsection