@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">city</th>
                                <th scope="col">hospital count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $item)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->hospitals_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
