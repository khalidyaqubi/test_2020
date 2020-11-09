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
                                النوع
                            </th>
                            <th >
                                المعاينة
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
                                <td>{{ $item->type==1?'صورة':'فيديو' }}</td>
                                <td>@if($item->type==1)
                                        <image width='122px' height='100px' src='{{asset('size1/'.$item->the_media)}}'/>
                                @else
                                        <iframe width="122" height="100" src="{{$item->the_media}}">
                                        </iframe>
                                    @endif
                                </td>
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

@endsection