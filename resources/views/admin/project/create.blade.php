@extends('layouts.dashboard.app')

@section('pageTitle','إضافة مشروع')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة المشاريع')
@section('navigation3','إضافة مشروع')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/projects')
@section('navigation3_link','/admin/projects/create')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إضافة مشروع
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/projects">
            @csrf
            <!-- Start Row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فئات المشروع
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <select required class="form-control kt-select2 select2-multi" name="p_categories_ids[]"
                                        id="p_categories_ids" multiple>
                                    <option value=" " disabled>فئة المشروع</option>
                                    @foreach($p_categories as $p_category)
                                        <option value="{{$p_category->id}}"
                                                @if(collect(old('p_categories_ids'))->contains($p_category->id))selected @endif>{{$p_category->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <input type="hidden" name="fixing"
                           value="0">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"> تثبيت المشروع
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input type="checkbox" name="fixing"
                                       {{old('fixing')?"checked":" "}} value="1"
                                       style="width: 39px; height: 39px; margin: 0px 35px;">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-4">
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
                    <!-- Start col -->
                    <div class="col-lg-4">
                        <div class="form-group ">
                            <label class="col-form-label col-lg-12"> الحاجة للتمويل
                            </label>
                            <select class="form-control" name="super_donation">
                                <option value="">أختر...</option>
                                <option value="1" @if(old("super_donation")==1)selected @endif>نعم
                                </option>
                                <option value="0" @if(old("super_donation")==='0')selected @endif>
                                    لا
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-4" id="donation" style="display: none">
                        <div class="form-group">
                            <label class="col-form-label col-lg-12">المبلغ المطلوب بالدولار
                                <span style="color:red;">*</span></label>
                            <input  class="form-control "
                                    type="number"
                                    value="{{old("need_amount")}}"
                                    name="need_amount"
                                    maxlength="16" min="0">
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12 ">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                الصورة الرئيسية
                                <span style="color:red">(500x500)</span>
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
                    <!-- end col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان بالعربي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="title_ar" type="text" name="title_ar"
                                       value="{{old("title_ar")}}" placeholder="العنوان بالعربي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان الفرعي بالعربي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea required class="form-control" id="details_ar" type="text" name="details_ar"
                                          placeholder="العنوان الفرعي بالعربي"
                                          style="width: 100%">{{old("details_ar")}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->

                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان بالتركي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="title_tr" type="text" name="title_tr"
                                       value="{{old("title_tr")}}" placeholder="العنوان بالتركي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان الفرعي بالتركي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea required class="form-control" id="details_tr" type="text" name="details_tr"
                                          placeholder="العنوان الفرعي بالتركي"
                                          style="width: 100% ;">{{old("details_tr")}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->

                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان بالإنجليزي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="title_en" type="text" name="title_en"
                                       value="{{old("title_en")}}" placeholder="العنوان بالإنجليزي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان الفرعي بالإنجليزي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea required class="form-control" id="details_en" type="text" name="details_en"
                                          placeholder="العنوان الفرعي بالإنجليزي"
                                          style="width: 100%">{{old("details_en")}}</textarea>
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
    <script src="{{asset('new_theme/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>

    <script>

        $(document).ready(function () {

            if ($("[name='super_donation']").val() == 1) {
                $('#donation').show();
            }
            if ($("[name='super_donation']").val() === '0') {
                $("[name='need_amount']").val(0);
                $('#donation').hide();
            }
        });

        $("[name='super_donation']").change(function () {
            if ($("[name='super_donation']").val() == 1) {
                $('#donation').show();
            }
            if ($("[name='super_donation']").val() === '0') {
                $("[name='need_amount']").val(0);
                $('#donation').hide();
            }
        });
    </script>
@endsection