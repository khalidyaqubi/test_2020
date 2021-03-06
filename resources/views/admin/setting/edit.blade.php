@extends('layouts.dashboard.app')

@section('pageTitle','تعديل إعدادات الموقع')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','تعديل إعدادت الموقع')
@section('navigation3','')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/settings/1/edit')
@section('navigation3_link','')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        تعديل إعدادت الموقع
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/settings/1">
            @csrf
            @method('put')
            <!-- Start Row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">البريد الإلكتروني

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="email" type="text" name="email"
                                       value="{{ $item->email }}" placeholder="البريد الإلكتروني">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رقم التواصل

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="phone" type="text" name="phone"
                                       value="{{ $item->phone }}" placeholder="رقم التواصل">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">العنوان بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="address_ar" type="text" name="address_ar"
                                       value="{{ $item->address_ar }}" placeholder="العنوان بالعربي">
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
                                <input required class="form-control" id="address_tr" type="text" name="address_tr"
                                       value="{{ $item->address_tr }}" placeholder="العنوان بالتركي">
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
                                <input required class="form-control" id="address_en" type="text" name="address_en"
                                       value="{{ $item->address_en }}" placeholder="العنوان بالإنجليزي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">كلمة التذييل بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control arabic" id="footer_ar" type="text" name="footer_ar"
                                            placeholder="كلمة التذييل بالعربي">{{ $item->footer_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">كلمة التذييل بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control arabic" id="footer_tr" type="text" name="footer_tr"
                                            placeholder="كلمة التذييل بالتركي">{{ $item->footer_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">كلمة التذييل بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control arabic" id="footer_en" type="text" name="footer_en"
                                            placeholder="كلمة التذييل بالإنجليزي">{{ $item->footer_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رابط الفيسبوك

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="facebook" type="text" name="facebook"
                                       value="{{ $item->facebook }}" placeholder="رابط الفيسبوك">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رابط تويتر

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="twitter" type="text" name="twitter"
                                       value="{{ $item->twitter }}" placeholder="رابط تويتر">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رابط يوتيوب

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="youtube" type="text" name="youtube"
                                       value="{{ $item->youtube }}" placeholder="رابط يوتيوب">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رابط انستجرام

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="instagram" type="text" name="instagram"
                                       value="{{ $item->instagram }}" placeholder="رابط انستجرام">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فيديو الصفحة الرئيسية

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="main_video" type="text" name="main_video"
                                       value="{{ $item->main_video }}" placeholder="فيديو الصفحة الرئيسية">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فيديو عنّا

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control" id="about_us_video" type="text" name="about_us_video"
                                       value="{{ $item->about_us_video }}" placeholder="فيديو عنّا">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عن المشروع بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control arabic" id="our_object_ar" type="text" name="our_object_ar"
                                           placeholder="عن المشروع بالعربي">{{ $item->our_object_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رسالتنا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control arabic" id="our_mission_ar" type="text" name="our_mission_ar"
                                           placeholder="رسالتنا بالعربي">{{ $item->our_mission_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">نشاطنا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control arabic" id="our_active_ar" type="text" name="our_active_ar"
                                            placeholder="نشاطنا بالعربي">{{ $item->our_active_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عبارة عنّا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control arabic" id="who_are_we_ar" type="text" name="who_are_we_ar"
                                            placeholder="عبارة عنّا بالعربي">{{ $item->who_are_we_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عنوان رؤيتنا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input required class="form-control arabic" id="our_vision_tilte_ar" type="text" name="our_vision_tilte_ar"
                                       value="{{ $item->our_vision_tilte_ar }}" placeholder="عنوان رؤيتنا بالعربي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">اقتباس رؤيتنا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control arabic" id="our_vision_quotes_ar" type="text" name="our_vision_quotes_ar"
                                            placeholder="اقتباس رؤيتنا بالعربي">{{ $item->our_vision_quotes_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">محتوى رؤيتنا بالعربي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control arabic" id="our_vision_content_ar" type="text" name="our_vision_content_ar"
                                            placeholder="محتوى رؤيتنا بالعربي">{{ $item->our_vision_content_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عن المشروع بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control turkey" id="our_object_tr" type="text" name="our_object_tr"
                                           placeholder="عن المشروع بالتركي">{{ $item->our_object_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رسالتنا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_mission_tr" type="text" name="our_mission_tr"
                                           placeholder="رسالتنا بالتركي">{{ $item->our_mission_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">نشاطنا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_active_tr" type="text" name="our_active_tr"
                                           placeholder="نشاطنا بالتركي">{{ $item->our_active_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                   
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عبارة عنّا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="who_are_we_tr" type="text" name="who_are_we_tr"
                                            placeholder="عبارة عنّا بالتركي">{{ $item->who_are_we_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عنوان رؤيتنا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input  required class="form-control turkey" id="our_vision_tilte_tr" type="text" name="our_vision_tilte_tr"
                                           value="{{ $item->our_vision_tilte_tr }}" placeholder="عنوان رؤيتنا بالتركي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">اقتباس رؤيتنا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_vision_quotes_tr" type="text" name="our_vision_quotes_tr"
                                            placeholder="اقتباس رؤيتنا بالتركي">{{ $item->our_vision_quotes_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">محتوى رؤيتنا بالتركي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                               <textarea  style="height: 100px;"  required class="form-control turkey" id="our_vision_content_tr" type="text" name="our_vision_content_tr"
                                           placeholder="محتوى رؤيتنا بالتركي">{{ $item->our_vision_content_tr }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عن المشروع بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_object_tr" type="text" name="our_object_en"
                                           placeholder="عن المشروع بالإنجليزي">{{ $item->our_object_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">رسالتنا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_mission_en" type="text" name="our_mission_en"
                                           placeholder="رسالتنا بالإنجليزي">{{ $item->our_mission_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                   
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">نشاطنا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_active_en" type="text" name="our_active_en"
                                            placeholder="نشاطنا بالإنجليزي">{{ $item->our_active_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عبارة عنّا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="who_are_we_en" type="text" name="who_are_we_en"
                                           placeholder="عبارة عنّا بالإنجليزي">{{ $item->who_are_we_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">عنوان رؤيتنا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input  required class="form-control turkey" id="our_vision_tilte_en" type="text" name="our_vision_tilte_en"
                                       value="{{ $item->our_vision_tilte_en }}" placeholder="عنوان رؤيتنا بالإنجليزي">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">اقتباس رؤيتنا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;" required class="form-control turkey" id="our_vision_quotes_en" type="text" name="our_vision_quotes_en"
                                            placeholder="اقتباس رؤيتنا بالإنجليزي">{{ $item->our_vision_quotes_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">محتوى رؤيتنا بالإنجليزي

                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  style="height: 100px;"  required class="form-control turkey" id="our_vision_content_en" type="text" name="our_vision_content_en"
                                            placeholder="محتوى رؤيتنا بالإنجليزي">{{ $item->our_vision_content_en }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    
                    <!-- Start col -->
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة عنّا
                                <span style="color:red">(3840x1750)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar1">
                                    @if(((!is_null($item->about_us_img)) && (!is_null($item->about_us_img)) && (($item->about_us_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->about_us_img) }})">
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
                                        <input name="about_us_img" accept="image/png, image/jpeg, image/jpg"
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة اتصل بنا
                                <span style="color:red">(3840x1750)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar2">
                                    @if(((!is_null($item->about_us_img2)) && (!is_null($item->about_us_img2)) && (($item->about_us_img2 != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->about_us_img2) }})">
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
                                        <input name="about_us_img2" accept="image/png, image/jpeg, image/jpg"
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة قسم الميديا
                                <span style="color:red">(5760x2400)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar3">
                                    @if(((!is_null($item->media_img)) && (!is_null($item->media_img)) && (($item->media_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->media_img) }})">
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
                                        <input name="media_img" accept="image/png, image/jpeg, image/jpg"
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة رؤيتنا
                                <span style="color:red">(3840x1750)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar4">
                                    @if(((!is_null($item->our_vision_img)) && (!is_null($item->our_vision_img)) && (($item->our_vision_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->our_vision_img) }})">
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
                                        <input name="our_vision_img" accept="image/png, image/jpeg, image/jpg"
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة شعار الموقع
                                <span style="color:red">(500x500)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar5">
                                    @if(((!is_null($item->icon_img)) && (!is_null($item->icon_img)) && (($item->icon_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->icon_img) }})">
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
                                        <input name="icon_img" accept="image/png, image/jpeg, image/jpg"
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
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة الصفحات
                                <span style="color:red">(3840x1750)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar6">
                                    @if(((!is_null($item->page_img)) && (!is_null($item->page_img)) && (($item->page_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->page_img) }})">
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
                                        <input name="page_img" accept="image/png, image/jpeg, image/jpg"
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

                    {{--<!-- Start col -->--}}
                    {{--<div class="col-md-3">--}}
                        {{--<div class="form-group row">--}}
                            {{--<label class="col-form-label col-lg-12">--}}
                                {{--صورة الرئيسية--}}
                                {{--<span style="color:red">(3840x1750)</span>--}}
                            {{--</label>--}}
                            {{--<div class="">--}}
                                {{--<div class="kt-avatar kt-avatar--outline"--}}
                                     {{--id="kt_user_avatar7">--}}
                                    {{--@if(((!is_null($item->main_img)) && (!is_null($item->main_img)) && (($item->main_img != ''))))--}}
                                        {{--<div class="kt-avatar__holder"--}}
                                             {{--style="background-image: url({{ asset($item->main_img) }})">--}}
                                        {{--</div>--}}
                                    {{--@else--}}
                                        {{--<div class="kt-avatar__holder"--}}
                                             {{--style="background-image: url('../../assets/images/users/2.jpg')">--}}
                                        {{--</div>--}}
                                    {{--@endif--}}

                                    {{--<label class="kt-avatar__upload"--}}
                                           {{--data-toggle="kt-tooltip" title=""--}}
                                           {{--data-original-title="Change avatar">--}}
                                        {{--<i class="fa fa-pen"></i>--}}
                                        {{--<input name="main_img" accept="image/png, image/jpeg, image/jpg"--}}
                                               {{--type="file">--}}
                                    {{--</label>--}}
                                    {{--<span class="kt-avatar__cancel"--}}
                                          {{--data-toggle="kt-tooltip" title=""--}}
                                          {{--data-original-title="Cancel avatar">--}}
																			{{--<i class="fa fa-times"></i>--}}
																		{{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- End col -->--}}

                    <!-- Start col -->
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                صورة صفحة التبرع
                                <span style="color:red">(3840x1750)</span>
                            </label>
                            <div class="">
                                <div class="kt-avatar kt-avatar--outline"
                                     id="kt_user_avatar8">
                                    @if(((!is_null($item->donate_img)) && (!is_null($item->donate_img)) && (($item->donate_img != ''))))
                                        <div class="kt-avatar__holder"
                                             style="background-image: url({{ asset($item->donate_img) }})">
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
                                        <input name="donate_img" accept="image/png, image/jpeg, image/jpg"
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
@endsection