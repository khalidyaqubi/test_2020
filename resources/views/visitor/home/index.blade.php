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
                <div class="col-lg-12">
                    <div class="single_reson">
                        <div class="thum">
                            <div class="thum_1">
                               <a href="/articles/{{$fixed_article->id}}"></a> <img src="{{asset("size7/".$fixed_article->img)}}" alt=""></a>
                            </div>
                        </div>
                        <div class="help_content" style="text-align: center;">
                           <a href="/articles/{{$fixed_article->id}}"></a> <h3>@if(config('app.locale')=='en')
                                    {{mb_substr($fixed_article->title_en, 0, 100)}}
                                @elseif(config('app.locale')=='tr')
                                    {{mb_substr($fixed_article->title_tr, 0, 100)}}
                                @elseif(config('app.locale')=='ar')
                                    {{mb_substr($fixed_article->title_ar, 0, 100)}}
                                @endif</h3></a>
                            <h6> @if(config('app.locale')=='en')
                                    {{mb_substr($fixed_article->details_en, 0, 300)}}
                                @elseif(config('app.locale')=='tr')
                                    {{mb_substr($fixed_article->details_tr, 0, 300)}}
                                @elseif(config('app.locale')=='ar')
                                    {{mb_substr($fixed_article->details_ar, 0, 300)}}
                                @endif</h6>
                            <a href="/articles/{{$fixed_article->id}}"
                               class="read_more">{{trans('my-word.Read More')}}</a>
                        </div>
                    </div>
                </div>
                <br><br>
            @endif
            <div class="row justify-content-center">
                @foreach($last_6_articles as $article)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="single_reson">
                            <div class="thum">
                                <div class="thum_1">
                                  <a href="/articles/{{$article->id}}"> <img src="{{asset("size1/".$article->img)}}" alt=""></a> 
                                </div>
                            </div>
                            <div class="help_content" >
                                <h3 style="max-height: 50px;
    height: 50px;
    overflow: hidden;">@if(config('app.locale')=='en')
                                        {{mb_substr($article->title_en, 0, 100)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{mb_substr($article->title_tr, 0, 100)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{mb_substr($article->title_ar, 0, 100)}}
                                    @endif</h3>
                                <h6 style="max-height: 100px; height: 100px;overflow: hidden;"> @if(config('app.locale')=='en')
                                        {{mb_substr($article->details_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{mb_substr($article->details_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{mb_substr($article->details_ar, 0, 300)}}
                                    @endif</h6>
                                <a href="/articles/{{$article->id}}"
                                   class="read_more">{{trans('my-word.Read More')}}</a>
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
                                <h3 class="counter d-inline">98 </h3>
                                <h3 class=" d-inline"><span>%</span></h3>
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
    <!-- latest_activites_area_start  -->]
    @if($fixed_project)
        <div class="latest_activites_area">
            <div class=" video_bg_1 video_activite  d-flex align-items-center justify-content-center"
                 style="background-image: url({{asset("size2/".$fixed_project->img)}});">

            </div>
            <div class="container">

                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="activites_info">
                            <div class="section_title">
                                <a href="/projects/{{$fixed_project->id}}">
                                    <h3>  @if(config('app.locale')=='en')
                                            {{mb_substr($fixed_project->title_en, 0, 100)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{mb_substr($fixed_project->title_tr, 0, 100)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{mb_substr($fixed_project->title_ar, 0, 100)}}
                                        @endif<br>
                                        {{trans('my-word.Need Our Help')}}
                                    </h3>
                                </a>
                            </div>
                            <span>{{trans('my-word.Beneficiaries')}}: {{$fixed_project->usefull}}   </span>
                            <p class="para_1">@if(config('app.locale')=='en')
                                    {{mb_substr($fixed_project->details_en, 0, 300)}}
                                @elseif(config('app.locale')=='tr')
                                    {{mb_substr($fixed_project->details_tr, 0, 300)}}
                                @elseif(config('app.locale')=='ar')
                                    {{mb_substr($fixed_project->details_ar, 0, 300)}}
                                @endif</p>
                            <a href="projects/{{$fixed_project->id}}/donations"
                               class="boxed-btn4">{{trans('my-word.Make a Donate')}}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
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
                                 <a href="/projects/{{$project->id}}">   <img src="{{asset("size1/".$project->img)}}" alt="">
                                 </a>
                                </div>
                                <div class="causes_content">
                                    <div class="custom_progress_bar">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width: {{ $project->need_amount?($project->come_amount/$project->need_amount)*100:100 }}%;"
                                                 aria-valuenow="{{ $project->need_amount?($project->come_amount/$project->need_amount)*100:100 }}"
                                                 aria-valuemin="0" aria-valuemax="100">
                                            <span class="progres_count">
                                                   {{ $project->need_amount?number_format(($project->come_amount/$project->need_amount)*100, 2, '.', ' ') :100}} %
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="balance d-flex justify-content-between align-items-center">
                                        <span>{{trans('my-word.Raised')}}: {{$project->come_amount}} $  </span>
                                        <span>{{trans('my-word.Goal')}}: {{$project->need_amount}} $ </span>
                                       <span>{{trans('my-word.Beneficiaries')}}: {{$project->usefull}}   </span>
                                    </div>
                                    <a href="/projects/{{$project->id}}">  <h4 style="max-height: 50px;
    height: 50px;
    overflow: hidden;">@if(config('app.locale')=='en')
                                            {{mb_substr($project->title_en, 0, 100)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{mb_substr($project->title_tr, 0, 100)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{mb_substr($project->title_ar, 0, 100)}}
                                        @endif</h4></a>
                                    <p style="max-height: 200px;
    height: 200px;
    overflow: hidden;">@if(config('app.locale')=='en')
                                            {{mb_substr($project->details_en, 0, 300)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{mb_substr($project->details_tr, 0, 300)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{mb_substr($project->details_ar, 0, 300)}}
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
    <div class="site-blocks-cover overlay inner-page-cover"
         style="background-image: url({{ asset($setting->media_img) }});" data-aos="fade"
         data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="/medias"><h1 class="text-white">{{trans('my-word.Our Media')}}</h1></a>
                </div>
            </div>
        </div>
    </div>
    <!--Our Media End-->
@endsection

@section('footerCSS')
@endsection

@section('footerJS')
<script>
 $(document).ready(function () {
     /*       for(i=0;i<$('.owl-nav').length;i++){
$('.owl-nav').eq(i).removeClass("disabled");
}
$('.owl-nav').click(function(event) {
  $(this).removeClass('disabled');
});*/
@if(config('app.locale')=='ar')
for(i=0;i<$('.owl-prev').length;i++){
$('.owl-prev').eq(i).html('<img src="https://d1ycj7j4cqq4r8.cloudfront.net/bbb447994b253bea1bb81b002e3413b2.svg" />').css({"background-color": "#3CC78F", "margin": "-195px"});
}
for(i=0;i<$('.owl-next').length;i++){
$('.owl-next').eq(i).html('<img src="https://d1ycj7j4cqq4r8.cloudfront.net/20bd4ea61b53e89f4d8c6531d59f19ab.svg" />').css({"background-color": "#3CC78F", "margin": "-195px"});
}
@else
for(i=0;i<$('.owl-next').length;i++){
$('.owl-next').eq(i).html('<img src="https://d1ycj7j4cqq4r8.cloudfront.net/bbb447994b253bea1bb81b002e3413b2.svg" />').css({"background-color": "#3CC78F", "margin": "-195px"});
}
for(i=0;i<$('.owl-prev').length;i++){
$('.owl-prev').eq(i).html('<img src="https://d1ycj7j4cqq4r8.cloudfront.net/20bd4ea61b53e89f4d8c6531d59f19ab.svg" />').css({"background-color": "#3CC78F", "margin": "-195px"});
}
@endif
 });
</script>
@endsection