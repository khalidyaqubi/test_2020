@extends('layouts.app')

@section('pageTitle')
    {{trans('my-word.Popular Project')}}
@endsection

@section('headerCSS')

@endsection

@section('headerJS')
@endsection

@section('content')
    <!-- Endowment_Projects_Page_start  -->
    <div class="popular_causes_area section_padding">
        <div class="container">
            <div>
                <a href="/"> {{trans('my-word.Home')}} </a> >
                <a href="/projects"><span>{{trans('my-word.Popular Project')}} </span> </a>

            </div>
            <br>
            <div class="row">
                @foreach($items->chunk(3) as $projects)
                <div class="col-lg-12">
                    <div class="causes_active owl-carousel">

                        @foreach($projects as $project)
                        <div class="single_cause">
                            <div class="thumb">
                                 <a href="/projects/{{$project->id}}"> <img src="{{asset("size6/".$project->img)}}" alt=""></a>
                            </div>
                            <div class="causes_content">
                                <div class="custom_progress_bar">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $project->need_amount?($project->come_amount/$project->need_amount)*100:100 }}%;" aria-valuenow="{{ $project->need_amount?($project->come_amount/$project->need_amount)*100:100 }}" aria-valuemin="0" aria-valuemax="100">
                                            <span class="progres_count">
                                                     {{ $project->need_amount?number_format(($project->come_amount/$project->need_amount)*100, 2, '.', ' '):100 }} %
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="balance d-flex justify-content-between align-items-center">
                                    <span>{{trans('my-word.Raised')}}: {{$project->come_amount}} $</span>
                                    <span>{{trans('my-word.Goal')}}: {{$project->need_amount}} $ </span>
                                    <span>{{trans('my-word.Beneficiaries')}}: {{$project->usefull}}   </span>
                                </div>
                                <a href="/projects/{{$project->id}}">
                                    <h4 style="max-height: 50px;
    height: 50px;
    overflow: hidden;">
                                        @if(config('app.locale')=='en')
                                            {{mb_substr($project->title_en, 0, 100)}}
                                        @elseif(config('app.locale')=='tr')
                                            {{mb_substr($project->title_tr, 0, 100)}}
                                        @elseif(config('app.locale')=='ar')
                                            {{mb_substr($project->title_ar, 0, 100)}}
                                        @endif</h4>
                                </a>
                                <p style="max-height: 200px;
    height: 200px;
    overflow: hidden;">@if(config('app.locale')=='en')
                                        {{mb_substr($project->details_en, 0, 300)}}
                                    @elseif(config('app.locale')=='tr')
                                        {{mb_substr($project->details_tr, 0, 300)}}
                                    @elseif(config('app.locale')=='ar')
                                        {{mb_substr($project->details_ar, 0, 300)}}
                                    @endif</p>
                                <h6>{{$project->donations->pluck('id')->count()}} {{trans('my-word.supports')}} </h6>
                                <div>
                                    <a href="projects/{{$project->id}}/donations"  class="boxed-btn">
                                        <span class="fa fa-heart"> {{trans('my-word.DONATE NOW')}}</span> </a>
                                </div>
                            </div>

                        </div>
                            @endforeach

                    </div>
                </div>
                    @endforeach
                    {{$items->links()}}
            </div>
        </div>
    </div>
    <!-- Endowment_Projects_Page_End  -->



@endsection

@section('footerCSS')
@endsection

@section('footerJS')

@endsection