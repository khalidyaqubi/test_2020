@extends('layouts.dashboard.app')

@section('pageTitle','إضافة خبر')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الأخبار')
@section('navigation3','إضافة خبر')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/articles')
@section('navigation3_link','/admin/articles/create')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إضافة خبر
                    </h3>
                </div>
            </div>
            <form class="kt-portlet__body"
                  enctype="multipart/form-data"
                  method="post" action="/admin/articles">
            @csrf
            <!-- Start Row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">فئات الخبر
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <select  required class="form-control kt-select2 select2-multi" name="a_categories_ids[]"
                                         id="a_categories_ids" multiple>
                                    <option value=" " disabled>فئة الخبر</option>
                                    @foreach($a_categories as $a_category)
                                        <option value="{{$a_category->id}}"
                                                @if(collect(old('a_categories_ids'))->contains($a_category->id))selected @endif>{{$a_category->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <input type="hidden" name="status"
                           value="0">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"> تفعيل الخبر
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input  type="checkbox" name="status"
                                        {{old('status')?"checked":" "}} value="1"
                                        style="width: 39px; height: 39px; margin: 0px 35px;">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <input type="hidden" name="fixing"
                           value="0">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"> تثبيت الخبر
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <input  type="checkbox" name="fixing"
                                        {{old('fixing')?"checked":" "}} value="1"
                                        style="width: 39px; height: 39px; margin: 0px 35px;">
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-3">
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
                    <div class="col-md-12 " >
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">
                                الصورة الرئيسية
                                <span style="color:red">(750X375)</span>
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
                                <input required class="form-control  arabic" id="title_ar" type="text" name="title_ar"
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
                                <textarea required class="form-control arabic" id="details_ar" type="text" name="details_ar"
                                          placeholder="العنوان الفرعي بالعربي" style="width: 100%">{{old("details_ar")}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">المحتوى بالعربي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  class="form-control my-editor arabic" id="the_file_ar" type="text" name="the_file_ar"
                                           placeholder="المحتوى العربي" style="width: 100% ; height:230px">{{old("the_file_ar")}}</textarea>
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
                                <input required class="form-control turkey " id="title_tr" type="text" name="title_tr"
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
                                <textarea required class="form-control turkey" id="details_tr" type="text" name="details_tr"
                                          placeholder="العنوان الفرعي بالتركي" style="width: 100% ;">{{old("details_tr")}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">المحتوى بالتركي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  class="form-control my-editor turkey" id="the_file_tr" type="text" name="the_file_tr"
                                          placeholder="المحتوى بالتركي" style="width: 100% ; height:230px">{{old("the_file_tr")}}</textarea>
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
                                <input required class="form-control turkey" id="title_en" type="text" name="title_en"
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
                                <textarea required class="form-control turkey" id="details_en" type="text" name="details_en"
                                          placeholder="العنوان الفرعي بالإنجليزي" style="width: 100%">{{old("details_en")}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">المحتوى بالإنجليزي
                                <span style="color:red;">*</span></label>
                            <div style="width: 95%;">
                                <textarea  class="form-control my-editor turkey" id="the_file_en" type="text" name="the_file_en"
                                           placeholder="المحتوى بالإنجليزي" style="width: 100% ; height:230px">{{old("the_file_en")}}</textarea>
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

    <script src="//cdn.tinymce.com/4/tinymce.min.js?apiKey=tvz10gsfkdi95v46ht76944xjv437ed3apv2id60nuthpye8"></script>
    <script>

        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };


        tinymce.init(editor_config);

    </script>

@endsection