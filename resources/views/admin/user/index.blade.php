@extends('layouts.dashboard.app')

@section('pageTitle','إدارة المستخدمين')
@section('headerCSS')
    <link href="{{asset('new_theme/assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة المستخدمين')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/users')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة المستخدمين
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
                                <label class="col-form-label col-lg-12">اسم المستخدم </label>
                                <div style="width: 95%;">
                                    <input class="form-control"
                                           placeholder="اكتب  اسم المستخدم" id="name" name="name"
                                           value="{{$name}}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">البريد  الإلكتروني</label>
                                <div style="width: 95%;">
                                    <input class="form-control" placeholder=" اكتب الإيميل  " id="email" name="email"
                                           value="{{$email}}"
                                           >
                                </div>
                            </div>
                        </div>
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
                                    اسم المستخدم
                                </th>
                            <th >
                                البريد الإلكتروني
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
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="dropdown dropdown-inline">
                                            <button type="button"
                                                    class="btn btn-success btn-hover-success btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="/admin/users/{{$item->id}}/edit"><i
                                                            class="fa fa-pen"></i>
                                                    تعديل
                                                </a>
                                                <a class="dropdown-item" href="/admin/users/permission/{{$item->id}}">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    صلاحيات</a>
                                                <a class="dropdown-item Confirm" href="/admin/users/delete/{{$item->id}}">
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

    <script src="{{asset('new_theme/assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('new_theme/assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('new_theme/assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('new_theme/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
@endsection