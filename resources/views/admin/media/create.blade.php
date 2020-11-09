@extends('layouts.dashboard.app')

@section('pageTitle','إضافة وسائط')
@section('headerCSS')
    <link href="{{asset('new_theme/assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الوسائطة')
@section('navigation3','إضافة وسائط')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/medias')
@section('navigation3_link','/admin/medias/create')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
إضافة وسائط
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"  enctype="multipart/form-data" method="post" action="/admin/medias">
            @csrf
            <!-- Start Row -->
                <div class="row">

                    <!-- Start col -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group row">
                            <label  class="col-form-label col-lg-12">نوع وسائط</label>
                            <div style="width: 95%;">
                                <select required class="form-control kt-select2 select2-multi"
                                        name="type" id="type" onchange="change_type()">
                                    <option  value="" selected>نوع الوسائط</option>
                                    <option value="1" @if(old('type') == 1)selected @endif> صورة</option>
                                    <option value="2" @if(old('type') == 2)selected @endif> فيديو</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->

                    <!-- Start col -->
                    <div  id="type2" class="col-md-12 " style="display: none">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فيديو

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input  class="form-control" id="link" type="text" name="link"
                                       value="{{ old('link') }}" placeholder="فيديو">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div id="type1" class="col-md-12 " style="display: none" >
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة

                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar">

                                        <div class="kt-avatar__holder"
                                             style="background-image: url('../../assets/images/users/2.jpg')">
                                        </div>
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
                    <!-- Start col -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group ">
                            <label class="col-form-label col-lg-12">تاريخ الرفع
                                <span
                                        style="color:red;">*</span></label>
                            <input required class="form-control datepicker-custome" placeholder="yyyy-mm-dd" readonly="readonly" type="text"
                                   name="created_at"
                                   value="{{old('created_at')??Carbon\Carbon::now()->format('Y-m-d')}}" style="width: 86%" placeholder="-تاريخ الرفع-">
                        </div>
                    </div>
                    <!-- End col -->
                     <!-- Satrt Button Confirm -->
                     <div class="col-12">
                    <div class="form-group row">
                    <button type="submit"
                            class="btn btn-success btn-elevate btn-block col ">إضافة
                        <span id="wating" class="" style="display: none">                            &nbsp;&nbsp;
                            <span class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </span>
                            <span class="text-primary">&nbsp;&nbsp; الرجاء الانتظار...</span>
                        </span>
                    </button>
                    </div>

                </div>
                </div>
            </form>
        </div>
        <!--end::Portlet-->
    </div>


@endsection
@section('select2')
@endsection
@section('footerJS')
    <script src="{{asset('new_theme/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>


    <script>
        //type
        function change_type(e) {
            console.log($("#type").val());
            if ($("#type").val() == '1') {
                $('#type1').show();
                $('#type2').hide();
                $("[name='link']").val("");
            } else if ($("#type").val() == '2') {
                $('#type2').show();
                $('#type1').hide();
                $("[name='img']").val("");
            }
        }
    </script>
@endsection