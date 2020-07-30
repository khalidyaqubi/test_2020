@extends('layouts.dashboard.app')

@section('pageTitle','تعديل المستخدم')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة المستخدمين')
@section('navigation3','تعديل المستخدم')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/users')
@section('navigation3_link','/admin/users/'.$user->id.'/edit')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        تعديل المستخدم {{$user->name}}
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/users/{{$user->id}}">
            @csrf
            @method('put')
            <!-- Start Row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">إسم
                                المستخدم
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="name" type="text" name="name"
                                       value="{{ $user->name }}" placeholder="إسم المستخدم">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">البريد
                                الإلكتروني
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="email" type="email"
                                       name="email" value="{{$user->email}}"
                                       placeholder="البريد الإلكتروني">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- End col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">كلمة السر
                                الحالية</label>
                            <div style="width: 95%;">
                                <input class="form-control" type="password"
                                       id="current_password" name="current_password"
                                       placeholder="كلمة السر الحالية">
                            </div>
                        </div>
                    </div>
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">كلمة السر
                                الجديدة</label>
                            <div style="width: 95%;">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="كلمة السر الجديدة">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">تأكيد كلمة
                                السر</label>
                            <div style="width: 95%;">
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation" placeholder="تأكيد كلمة السر">
                            </div>
                        </div>
                    </div>
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