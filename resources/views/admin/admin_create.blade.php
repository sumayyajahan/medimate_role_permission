@extends('layouts.admin')
@section('title','Admin Create')
@section('content')
@include('includes.banner',['one'=>'Admin','two'=>'Create'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.admins.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Admin</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{old('name')}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input value="{{old('mobile')}}" type="text" class="form-control" name="mobile" minlength="11" maxlength="11"
                                value="" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{old('email')}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                           <select class="form-control" name="role" required>
                               <option value="Super Admin">Super Admin</option>
                               <option value="Receptionist">Receptionist</option>
                               <option value="Moderator">Moderator</option>
                               <option value="Service Administration">Service Administration</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <input type="hidden" name="admin_id" value="{{Auth::id()}}">
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Add New</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection