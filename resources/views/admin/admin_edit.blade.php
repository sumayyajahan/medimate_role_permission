@extends('layouts.admin')
@section('title','Admin Edit')
@section('content')
@include('includes.banner',['one'=>'Admin','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.admins.update',$admin->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Admin</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{$admin->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input value="{{$admin->mobile}}" type="text" class="form-control" name="mobile"
                                minlength="11" maxlength="11" value="" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled value="{{$admin->email}}" type="email" class="form-control" name="email"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option @if($admin->role == 'Super Admin') selected @endif value="Super Admin">Super
                                    Admin </option>
                                <option @if($admin->role == 'Receptionist') selected @endif
                                    value="Receptionist">Receptionist</option>
                                <option @if($admin->role == 'Moderator') selected @endif value="Moderator">Moderator
                                </option>
                                <option @if($admin->role == 'Service Administration') selected @endif value="Service Administration">Service Administration</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection