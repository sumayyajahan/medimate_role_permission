<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Roles')
@section('content')
    @include('includes.banner',['one'=>'Roles','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Role</b>
                        <span><a class="btn btn-success" href="{{route('admin.roles.create')}}">Add New Role</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" id="form_submit{{$role->id}}" method="POST" class="form-inline" style="display:inline">
                                         @csrf
                                         @method('DELETE')
                                        <a href="javascript:void(0)" onclick="document.getElementById('form_submit{{$role->id}}').submit()" class="btn btn-sm btn-danger">Del</a>
                                        </form>
                                        </td>
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
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

@endpush
