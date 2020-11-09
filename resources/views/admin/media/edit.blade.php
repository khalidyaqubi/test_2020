@extends('layouts.dashboard.app')

@section('pageTitle','تعديل وسائط')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الوسائط')
@section('navigation3','تعديل وسائط')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/medias')
@section('navigation3_link','/admin/medias/'.$item->id.'/edit')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        تعديل الوسائط {{$item->name_r}}
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/medias/{{$item->id}}">
            @csrf
            @method('put')
            <!-- Start Row -->
                <div class="row">

                    @if($item->type==2)
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فيديو
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="link" type="text" name="link"
                                       value="{{ $item->the_media }}" placeholder="فيديو">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    @else
                    <!-- Start col -->
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة
                               
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar">
                                    @if(((!is_null($item->the_media)) && (!is_null($item->the_media)) && (($item->the_media != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset('size1/'.$item->the_media)}})">
                                        </div>
                                    @else
                                        <div class="kt-avatar__holder"
                                             style="background-image: url('../../assets/images/users/2.jpg')">
                                        </div>
                                    @endif

                                    <label class="kt-avatar__upload"
                                           data-toggle="kt-tooltip" title=""
                                           data-original-title="Change avatar">
                                        <i class="fa fa-pen"></i>
                                        <input name="img" accept="image/png, image/jpeg, image/jpg"
                                               type="file">
                                    </label>
                                    <span class="kt-avatar__cancel"
                                          data-toggle="kt-tooltip" title=""
                                          data-original-title="Cancel avatar">
																			<i class="fa fa-times"></i>
																		</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    @endif
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group ">
                                <label class="col-form-label col-lg-12">تاريخ الرفع
                                    <span
                                            style="color:red;">*</span></label>
                                <input required class="form-control datepicker-custome" placeholder="yyyy-mm-dd" readonly="readonly" type="text"
                                       name="created_at"
                                       value="{{date('Y-m-d',strtotime($item->created_at))??Carbon\Carbon::now()->format('Y-m-d')}}" style="width: 86%" placeholder="-تاريخ الرفع-">
                            </div>
                        </div>
                </div>
                <!-- End Row -->

                <!-- Satrt Button Confirm -->
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-success btn-elevate btn-block ">حفظ
                    </button>
                </div>
                <!-- End Button Confirm -->
            </form>
        </div>
        <!--end::Portlet-->
    </div>


@endsection
@section('select2')

@endsection
@section('footerJS')
    <script src="{{asset('new_theme/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>

@endsection