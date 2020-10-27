@extends('layouts.dashboard.app')

@section('pageTitle','إضافة فئة')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة فئات المشاريع')
@section('navigation3','إضافة فئة')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/p_categories')
@section('navigation3_link','/admin/p_categories/create')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إضافة فئة
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/p_categories">
            @csrf
            <!-- Start Row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">الاسم بالعربي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control arabic" id="name_ar" type="text" name="name_ar"
                                       value="{{ old('name_ar') }}" placeholder="الاسم بالعربي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">الاسم بالتركي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control turkey" id="name_tr" type="text" name="name_tr"
                                       value="{{ old('name_tr') }}" placeholder="الاسم بالتركي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">الاسم بالإنجليزي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="name_en" type="text" name="name_en"
                                       value="{{ old('name_en') }}" placeholder="الاسم بالإنجليزية">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End Row -->

                <!-- Satrt Button Confirm -->
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-success btn-elevate btn-block ">حفظ
                        <span id="wating" class="" style="display: none">                            &nbsp;&nbsp;
                            <span class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </span>
                            <span class="text-primary">&nbsp;&nbsp; الرجاء الانتظار...</span>
                        </span>
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
@endsection