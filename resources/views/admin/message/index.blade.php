@extends('layouts.dashboard.app')

@section('pageTitle','إدارة الرسائل')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة الرسائل')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/messages')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة الرسائل
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
                                <label class="col-form-label col-lg-12">بحث في الرسائل </label>
                                <div style="width: 95%;">
                                    <input type="text"  class="form-control" name="q" value="{{request('q')}}"
                                             placeholder="كلمة البحث">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-form-label col-lg-12">بحث حسب تاريخ </label>
                                <div style="width: 95%;">
                                    <input class="form-control datepicker-custome" placeholder="yyyy-mm-dd" readonly="readonly" name="datee" type="text"
                                           value="{{$datee}}">
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
                            <th width="8%"></th>
                            <th width="14%">العنوان</th>
                            <th width="45%">المحتوى</th>
                            <th width="15%">البريد</th>
                            <th width="11%">المرسل</th>
                            <th width="16%">التاريخ</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$a->title}}</td>
                                <td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" >{{$a->content}}</td>
                                <td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$a->mail}}</td>
                                <td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" >{{$a->name}}</td>
                                <td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$a->datee}}</td>
                                <td><div class="dropdown dropdown-inline">
                                        <button type="button"
                                                class="btn btn-success btn-hover-success btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item Confirm" href="/admin/messages/delete/{{$a->id}}">
                                                <i class="fa fa-trash"></i>
                                                حذف</a>
                                            <a class="dropdown-item" href="/admin/messages/{{$a->id}}">
                                                <i class="fa fa-edit"></i>
                                                عرض</a>
                                        </div>
                                    </div></td>


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

@endsection
