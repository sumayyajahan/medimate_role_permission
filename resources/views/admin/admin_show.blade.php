@extends('layouts.admin')
@section('title','Admin View')
@section('content')
@include('includes.banner',['one'=>'Admin','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.admins.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>View Admin</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled value="{{$admin->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled value="{{$admin->mobile}}" type="text" class="form-control" name="mobile" minlength="11" maxlength="11"
                                value="" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled value="{{$admin->email}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required>
                                <option @if($admin->role == 'Super Admin') selected @endif value="Super Admin">Super Admin
                                </option>
                                <option @if($admin->role == 'Default Admin') selected @endif value="Default Admin">Default
                                    Admin</option>
                                <option @if($admin->role == 'Moderator') selected @endif value="Moderator">Moderator
                                </option>
                            </select>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection