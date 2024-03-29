@extends('layouts.dashboard.app')

@section('pageTitle','إدارة الوسائط')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الوسائط')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/medias')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة الوسائط
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!-- Start Row -->
                <form id="zmain_form">
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">نوع الوسائط </label>
                                <div style="width: 95%;">
                                    <select  class="form-control kt-select2 select2-multi"
                                            name="type" id="type" onchange="change_type()">
                                        <option  value="" selected>نوع الوسائط</option>
                                        <option value="1" @if($type == 1)selected @endif> صورة</option>
                                        <option value="2" @if($type == 2)selected @endif> فيديو</option>
                                    </select>
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
                            <form id="delete_form" action="/admin/medias/delete_group">
                                <input type="hidden" name="the_ids" id="myIds2">

                            </form>
                    </div>
                </div>
            </div>
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
                                النوع
                            </th>
                            <th >
                                المعاينة
                            </th>
                             <th >
                                حالة الوسائط
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
                                <td>{{ $item->type==1?'صورة':'فيديو' }}</td>
                     
                                <td>@if($item->type==1)
                                        <image width='122px' height='100px' src='{{asset('size1/'.$item->the_media)}}'/>
                                @else
                                        <iframe width="122" height="100" src="{{$item->the_media}}">
                                        </iframe>
                                    @endif
                                </td>
                                           <th >
                                    <div class="">
                            <span
                                    class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                <label>
                                    <input class="cbActive" type="checkbox"
                                           @if(auth()->user()->hasPermissionTo('edit medias'))
                                           {{$item->status?"checked":" "}} value="{{$item->id}}"
                                           @else
                                           {{$item->status?"checked":" "}}disabled
                                           title="لا تملك صلاحية اعتماد وسائط"
                                           value="{{$item->id}}"
                            @endif>
                                    <span></span>
                                </label>
                            </span>
                                    </div>

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
                                            <a class="dropdown-item" href="/admin/medias/{{$item->id}}/edit"><i
                                                        class="fa fa-pen"></i>
                                                تعديل
                                            </a>
                                            <a class="dropdown-item Confirm" href="/admin/medias/delete/{{$item->id}}">
                                                <i class="fa fa-trash"></i>
                                                حذف</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                    url: "/admin/medias/approve/" + id,
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