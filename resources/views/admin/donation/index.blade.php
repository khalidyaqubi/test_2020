@extends('layouts.dashboard.app')

@section('pageTitle','إدارة التبرعات')
@section('headerCSS')
@endsection

@section('navigation1','الرئيسية')
@section('navigation2','إدارة التبرعات')
@section('navigation1_link','/admin/home')
@section('navigation2_link','/admin/donations')
@section('content')

    <div class="col-lg-12 col-xl-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="fa fa-pen icon-padding"></span>
                    <h3 class="kt-portlet__head-title">
                        إدارة التبرعات
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
                                <div style="width: 95%;">
                                    <label class="col-form-label col-lg-12">المشاريع
                                    </label>
                                    <select class="form-control kt-select2 select2-multi"
                                            id="projects_ids" name="projects_ids[]" multiple="multiple">
                                        <option value=" ">المشاريع </option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}"
                                                    @if(in_array($project->id, $projects_ids)) selected @endif>{{$project->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-3 col-md-3 col-xl-3 col-sm-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">التمويل  من</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="from_amount"
                                           id="from_amount"
                                           value="{{$from_amount??""}}"
                                           placeholder="التمويل  من">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                        <!-- Start col -->
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">التمويل  الى</label>
                                <div style="width: 95%;">
                                    <input type="number" class="form-control"
                                           name="to_amount"
                                           id="to_amount"
                                           value="{{$to_amount??""}}"
                                           placeholder="التمويل  الى">
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
                            <th >
                                المشروع
                            </th>
                            <th >
                                التاريخ
                            </th>
                            <th >
                                المبلغ المتبرع به
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr class="text-center">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->project->title_en??$item->project->title_tr }}</td>

                                <td>{{$item->created_at->format('Y-m-d')}}
                                </td>
                                <td>{{ $item->amount }}</td>

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