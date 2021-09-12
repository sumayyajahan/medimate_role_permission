@extends('layouts.admin')
@section('title','Admin View')
@section('content')
@include('includes.banner',['one'=>'Admin','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Admin Accounts <a href="{{route('admin.admins.create')}}" style="margin-left: 20px" class="btn btn-primary pull-right">Add Admin</a></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Mobile</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->role}}</td>
                                    <td>{{$admin->mobile}}</td>
                                    <td>{{$admin->createdBy->name ?? 'Super Admin'}}</td>

                                    <td class="d-flex justify-content-around">
                                        <a href="{{route('admin.admins.show',$admin->id)}}"> <button
                                                class="m-1 btn btn-primary">View</button></a>
                                        <a href="{{route('admin.admins.edit',$admin->id)}}"> <button
                                                class="m-1 btn btn-success">Edit</button></a>

                                        <a class="m-1 btn btn-danger" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$admin->id}}').submit();}else{event.preventDefault()}">
                                            Delete</a>
                                        <form id="delete-form-{{$admin->id}}"
                                            action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
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