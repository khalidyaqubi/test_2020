@extends('layouts.dashboard.app')

@section('pageTitle','إدارة فئات الأخبار')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة فئات الأخبار')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/a_categories')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة فئات الأخبار
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!-- Start Row -->
                <form id="zmain_form">
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">الاسم بالعربية </label>
                                <div style="width: 95%;">
                                    <input class="form-control arabic"
                                           placeholder="اكتب  الاسم العربي" id="name_ar" name="name_ar"
                                           value="{{$name_ar}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">الاسم بالتركية </label>
                                <div style="width: 95%;">
                                    <input class="form-control turkey"
                                           placeholder="اكتب  الاسم التركي" id="name_tr" name="name_tr"
                                           value="{{$name_tr}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">الاسم  بالإنجليزية</label>
                                <div style="width: 95%;">
                                    <input class="form-control turkey"
                                           placeholder="اكتب  الاسم بالإنجليزية" id="name_en" name="name_en"
                                           value="{{$name_en}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-12">
                            <div class="form-group row">
                                <button type="submit"
                                        class="btn btn-success  col mr-3" name="theaction"
                                        value="search">بحث
                                </button>
                            </div>
                        </div>
                        <!-- End col -->
                    </div>
                </form>
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
                            <th >
                                الاسم بالعربي
                            </th>
                            <th >
                                الاسم بالتركي
                            </th>
                            <th >
                                الاسم بالإنجليزي
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
                                <td>{{ $item->name_ar }}</td>
                                <td>{{ $item->name_tr }}</td>
                                <td>{{ $item->name_en }}</td>
                                <td>
                                    <div class="dropdown dropdown-inline">
                                        <button type="button"
                                                class="btn btn-success btn-hover-success btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/admin/a_categories/{{$item->id}}/edit"><i
                                                        class="fa fa-pen"></i>
                                                تعديل
                                            </a>
                                            <a class="dropdown-item Confirm" href="/admin/a_categories/delete/{{$item->id}}">
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

@endsection