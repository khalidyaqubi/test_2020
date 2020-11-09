@extends('layouts.app')

@section('pageTitle')

    {{ \Carbon\Carbon::parse($media->created_at)->toFormattedDateString()}}
@endsection

@section('headerCSS')


@endsection

@section('headerJS')
@endsection



@section('content')


    <div class="container">
        <div class="section-top-border">
            <br>
            <div>
                <a href="/">{{trans('my-word.Home')}} </a> >
                <a href="/medias"><span>{{trans('my-word.Media Center')}} ></span> </a> >
                <a href="/medias/{{$media->id}}"><span> {{ \Carbon\Carbon::parse($media->created_at)->toFormattedDateString()}}</span></a>
            </div>
            <div class="row gallery-item">
                @foreach($medias as $item)
                <div class="col-md-4">
                    @if($item->type==1)
                    <a href="{{asset('size2/'.$item->the_media)}}" class="img-pop-up">
                        <div class="single-gallery-image" style="background: url({{asset('size2/'.$item->the_media)}});"></div>
                    </a>
                    @else
                        <iframe style="margin-top: 26px;    height: 100%;" src="{{$item->the_media}}">
                        </iframe>
                    @endif
                </div>
                    @endforeach
            </div>
        </div>
    </div>




@endsection

@section('footerCSS')
@endsection

@section('footerJS')


@endsection