@extends('layouts.admin')
@section('title','User Activity')
@section('content')
@include('includes.banner',['one'=>'User Activity','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Login Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->user->userid }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>{{ $user->user->name }}</td>
                                    <td>{{ $user->start }}</td>
                                </tr>
                                @endforeach

                                @foreach($doctors as $user)
                                <tr>
                                    <td>{{ $user->user->doctorid }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>{{ $user->user->name }}</td>
                                    <td>{{ $user->start }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
