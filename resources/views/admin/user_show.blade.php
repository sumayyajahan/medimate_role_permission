@extends('layouts.admin')
@section('title','View User')
@section('content')
@include('includes.banner',['one'=>'User','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="#" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View User</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled value="{{$user->name}}" type="text" class="form-control" name="name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled value="{{$user->mobile}}" type="text" class="form-control" name="mobile"
                                minlength="11" maxlength="11" value="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled disabled value="{{$user->email}}" type="email" class="form-control"
                                name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Referral Code</label>
                            <input disabled disabled value="{{$user->referral_code}}" type="email" class="form-control"
                                name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input disabled value="{{$user->dob}}" type="date" class="form-control" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input disabled value="{{$user->address}}" type="text" class="form-control" name="address"
                                required>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <select disabled required class="form-control" name="district" id="">
                                <option value="{{$user->district}}">{{$user->district}}</option>
                                <option value="District 1">District 1</option>
                                <option value="District 2">District 2</option>
                                <option value="District 3">District 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Police Station</label>
                            <select disabled required class="form-control" name="police_station" id="">
                                <option value="{{$user->police_station}}">{{$user->police_station}}</option>
                                <option value="Police Station 2">Police Station 2</option>
                                <option value="Police Station 3">Police Station 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Post Office</label>
                            <select disabled required class="form-control" name="post_office" id="">
                                <option value="{{$user->post_office}}">{{$user->post_office}}</option>
                                <option value="PPost Office 2">Post Office 1</option>
                                <option value="Post Office 3">Post Office 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>User Image</label>
                            <img height="480px" width="320px" src="{{asset('images/'.$user->image)}}" alt="">
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection