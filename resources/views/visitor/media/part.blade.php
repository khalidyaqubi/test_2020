@foreach($items_1 as $item_1)
    <div class="section-top-border">
        <h3 class="mb-30">
            <a href="\medias\{{$item_1->id}}">
                {{ \Carbon\Carbon::parse($item_1->created_at)->toFormattedDateString()}}</a>
        </h3>
        <div class="row owl-carousel owl-theme owl-loaded owl-drag">

            <div class="owl-stage-outer">
                <div class="owl-stage"
                     style="transition: all 0s ease 0s; width: 2464px; transform: translate3d(-672px, 0px, 0px);">
                    @php
                        $items = \App\Media::where('created_at',$item_1->created_at)->limit(5)->get();
                        ;
                    @endphp
                    <div class="owl-item cloned active" style="width: 214px; margin-right: 10px;">
                        <div class="item">

                            <img src="#" alt=""
                                 class="img-fluid">
                        </div>
                    </div>
                    <div class="owl-item cloned active" style="width: 214px; margin-right: 10px;">
                        <div class="item">

                            <img src="#" alt=""
                                 class="img-fluid">
                        </div>
                    </div>
                    <div class="owl-item cloned active" style="width: 214px; margin-right: 10px;">
                        <div class="item">

                            <img src="#" alt=""
                                 class="img-fluid">
                        </div>
                    </div>
                    @foreach($items as $item)

                        <div class="owl-item active center" style="width: 214px; margin-right: 10px;">
                            <div class="item">
                                @if($item->type==1)
                                    <img src="{{asset('size1/'.$item->the_media)}}" alt=""
                                         class="img-fluid">
                                @else
                                    <iframe width="200px" height="149px" src="{{$item->the_media}}">
                                    </iframe>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-nav disabled">
                <div class="owl-prev">prev</div>
                <div class="owl-next">next</div>
            </div>
            <div class="owl-dots disabled">
                <div class="owl-dot active"><span></span></div>
            </div>
        </div>
    </div>
@endforeach