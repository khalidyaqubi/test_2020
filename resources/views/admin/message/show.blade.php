@extends('layouts.dashboard.app')

@section('pageTitle','عرض الرسالة')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الرسائل')
@section('navigation3','عرض رسالة')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/messages')
@section('navigation3_link','/admin/messages/'.$item->id)
@section('content')
    <div class="row" style="width: 100%;">
        <div class="col-xs-10 padding-0 margin-0" style="padding-right:15px ; padding-left:0">
            <table class="table table-bordered padding-0 margin-0">
                <thead>
                <tr>
                    <th colspan=3 width="40%">المرسل : {{ $item->title }}</th>
					<th > {{ $item->datee }}</th>
					<th > {{ $item->mail }}</th>
					@if($item->mopile)<th > {{ $item->mopile }}</th>@endif
                </tr>
                </thead>
                <tbody>
                <tr>
                    
                    <td colspan=6>{{ $item->content }}</td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group row" style="width: 100%;">
        <div class="col-sm-5 col-md-offset-1">
            <a href="/admin/messages" class="btn btn-success">الغاء الامر</a>
        </div>
    </div>
@endsection
@section('select2')

@endsection
@section('footerJS')
    <script src="{{asset('new_theme/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>

@endsection