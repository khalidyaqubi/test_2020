@extends('layouts.dashboard.app')

@section('pageTitle','إدارة المشاريع')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة المشاريع')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/projects')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة المشاريع
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!-- Start Row -->
                <form id="zmain_form">
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">العنوان بالعربية </label>
                                <div style="width: 95%;">
                                    <input class="form-control arabic"
                                           placeholder="اكتب  العنوان العربي" id="title_ar" name="title_ar"
                                           value="{{$title_ar}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">العنوان بالتركية </label>
                                <div style="width: 95%;">
                                    <input class="form-control turkey"
                                           placeholder="اكتب  العنوان التركي" id="title_tr" name="title_tr"
                                           value="{{$title_tr}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">العنوان  بالإنجليزية</label>
                                <div style="width: 95%;">
                                    <input class="form-control"
                                           placeholder="اكتب  العنوان بالإنجليزية" id="title_en" name="title_en"
                                           value="{{$title_en}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                         <!-- Start col -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div style="width: 95%;">
                                    <label class="col-form-label col-lg-12">الحالة</label>
                                    <select class="form-control kt-select2 select2-multi"
                                            id="status" name="status">
                                        <option value=" " selected> الحالة</option>
                                        <option value="1" @if($status == 1)selected @endif> مقبول</option>
                                        <option value="0" @if($status === '0')selected @endif> غير مقبول</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div style="width: 95%;">
                                    <label class="col-form-label col-lg-12">التثبيت</label>
                                    <select class="form-control kt-select2 select2-multi"
                                            id="fixing" name="fixing">
                                        <option value=" " selected> التثبيت</option>
                                        <option value="1" @if($fixing == 1)selected @endif> مثبت</option>
                                        <option value="0" @if($fixing === '0')selected @endif> غير مثبت</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <div class="col-lg-3 col-md-3 col-xl-3 col-sm-12">
                            <div class="form-group row">
                                <div style="width: 97%;">
                                    <label class="col-form-label col-lg-12">الناشر</label>
                                    <select class="form-control kt-select2 select2-multi"
                                            name="users[]"
                                            id="users"
                                            multiple
                                    >
                                        <option value=" " disabled>الناشر</option>
                                        @foreach(  $the_users as $the_user)
                                            <option value="{{ $the_user->id }}"
                                                    @if(in_array($the_user->id, $users)) selected @endif
                                            >{{ $the_user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div style="width: 95%;">
                                    <label class="col-form-label col-lg-12">الفئات
                                    </label>
                                    <select class="form-control kt-select2 select2-multi"
                                            id="categories_ids" name="categories_ids[]" multiple="multiple">
                                        <option value=" ">الفئات </option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(in_array($category->id, $categories_ids)) selected @endif>{{$category->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div style="width: 95%;">
                                    <label class="col-form-label col-lg-12">الحاجة للتمويل</label>
                                    <select class="form-control kt-select2 select2-multi"
                                            id="need" name="need">
                                        <option value=" " selected> الحاجة للتمويل</option>
                                        <option value="1" @if($need == 1)selected @endif> يحتاج</option>
                                        <option value="0" @if($need === '0')selected @endif> لا يحتاج</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <div class="col-lg-3 col-md-3 col-xl-3 col-sm-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">التمويل المطلوب من</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="from_need_amount"
                                           id="from_need_amount"
                                           value="{{$from_need_amount??""}}"
                                           placeholder="التمويل المطلوب من">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">التمويل المطلوب الى</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="to_need_amount"
                                           id="to_need_amount"
                                           value="{{$to_need_amount??""}}"
                                           placeholder="التمويل المطلوب الى">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">مقدار التبرع من</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="from_come_amount"
                                           id="from_come_amount"
                                           value="{{$from_come_amount??""}}"
                                           placeholder="مقدار التبرع من">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-4 ">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">مقدار التبرع الى</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="to_come_amount"
                                           id="to_come_amount"
                                           value="{{$to_come_amount??""}}"
                                           placeholder="مقدار التبرع الى">
                                </div>
                            </div>
                        </div>
                        <!-- Start col -->
                        <div class="col-9">
                            <div class="form-group row">
                                <button type="submit"
                                        class="btn btn-success  col mr-3" name="theaction"
                                        value="search">بحث
                                </button>
                            </div>
                        </div>
                        <!-- End col -->
                        <div class="col-3">
                            <div class="form-group">
                               <button type="submit" form="delete_form"
                                            class="btn btn-outline-danger col-12" name="theaction"
                                            value="delete">تغيير حالة المحدد                                  </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-3">
                    <div class="form-group">
                            <form id="delete_form" action="/admin/projects/delete_group">
                                <input type="hidden" name="the_ids" id="myIds2">

                            </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12" id="the_error">

            </div>
        </div>
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-sign icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        عرض
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body ">
                <!-- Start Table  -->
                <div class="table-responsive">

                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 5%">
                                #
                            </th>
                             <th style="width: 5%;">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" id="check_all" name="check_all" type="checkbox"
                                               value="1">الكل
                                        <span></span>
                                    </label>
                                </th>
                            <th >
                                العنوان
                            </th>
                            <th >
                                الصورة
                            </th>
                            <th >
                                الفئات
                            </th>
                            <th >
                                الناشر
                            </th>
                            <th >
                                المبلغ المطلوب
                            </th>
                            <th >
                                المبلغ المتبرع به
                            </th>
                             <th >
                                عدد المستفيدين
                            </th>
                             <th >
                                حالة المشروع
                            </th>
                            <th >
                                تثبيت المشروع
                            </th>
                            <th >
                                العمليات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr class="text-center">
                                <td>{{ $item->id }}</td>
                                 <td>
                                            <div class="">
															<span
                                                                    class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
																<label>
																	<input type="checkbox" id="{{$item->id}}"
                                                                           name="ids[{{$item->id}}]" type="checkbox"
                                                                           value="1">
																	<span></span>
																</label>
															</span>
                                            </div>
                                        </td>
                                <td>{{ $item->title_ar??($item->title_en??$item->title_tr) }}</td>

                                <td><image width='122px' height='100px' src='{{asset("size1/".$item->img)}}'/>
                                </td>
                                <td>@foreach($item->p_categories as $category)
                                        <span class="tags">{{$category->name_ar}}</span>
                                    @endforeach
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->need_amount }}</td>
                                <td>{{ $item->come_amount }}</td>
                                 <td>{{ $item->usefull }}</td>
                                <th >
                                    <div class="">
                            <span
                                    class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                <label>
                                    <input class="cbActive" type="checkbox"
                                           @if(auth()->user()->hasPermissionTo('edit projects'))
                                           {{$item->status?"checked":" "}} value="{{$item->id}}"
                                           @else
                                           {{$item->status?"checked":" "}}disabled
                                           title="لا تملك صلاحية اعتماد مشروع"
                                           value="{{$item->id}}"
                            @endif>
                                    <span></span>
                                </label>
                            </span>
                                    </div>

                                </th>
                                <th >
                                    {{ $item->fixing==1?'مثبت':'غير مثبت' }}
                                </th>
                                <td>
                                    <div class="dropdown dropdown-inline">
                                        <button type="button"
                                                class="btn btn-success btn-hover-success btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/admin/projects/{{$item->id}}/edit"><i
                                                        class="fa fa-pen"></i>
                                                تعديل
                                            </a>
                                            <a class="dropdown-item Confirm" href="/admin/projects/delete/{{$item->id}}">
                                                <i class="fa fa-trash"></i>
                                                حذف</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$items->links()}}
                </div>
                <!-- End Table  -->

                <!--end: Pagination-->
            </div>
        </div>
        <!--end::Portlet-->
    </div>@endsection

@section('select2')
@endsection

@section('footerJS')
<script>
        $(function () {
            $(".cbActive").change(function () {

                var id = $(this).val();
                var mythis = this;
                mythis.disabled = true;
                $.ajax({
                    url: "/admin/projects/approve/" + id,
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (resp) {
                        console.log(mythis);
                        document.getElementById("the_error").innerHTML = '<div class="alert alert-success alert-dismissible">\n' + resp.message +
                            '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '            <span aria-hidden="true">&times;</span>\n' +
                            '        </button>\n' +
                            '    </div>';

                        mythis.disabled = false;
                        console.log(mythis);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        document.getElementById("the_error").innerHTML = '<div class="alert alert-danger alert-dismissible">\n' + jqXHR.responseJSON.message +
                            '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '            <span aria-hidden="true">&times;</span>\n' +
                            '        </button>\n' +
                            '    </div>';
                        mythis.checked = !(mythis.checked);
                        mythis.disabled = false;
                    },
                });
            });

        });
    </script>
     <script>

        var ids_array = [];
        var ids = "";
        $("#check_all").change(function () {

            for (var z = 0; z < $('input[name^="ids"]').length; z++) {
                if ($("#check_all")[0].checked) {
                    $('input[name^="ids"]')[z].setAttribute('checked', 'checked');
                } else {
                    $('input[name^="ids"]')[z].removeAttribute('checked')
                }
                ids_array = [];
                $("input:checkbox[name^='ids']:checked").each(function () {
                    ids_array.push($(this).attr("id"));
                });
            }

            ids = ids_array.join();
            document.getElementById("myIds2").value = ids;
        });
        $('input[name^="ids"]').change(function () {
            ids_array = [];
            $("input:checkbox[name^='ids']:checked").each(function () {
                ids_array.push($(this).attr("id"));
            });
            ids = ids_array.join();
            document.getElementById("myIds2").value = ids;
        });
    </script>
    
@endsection