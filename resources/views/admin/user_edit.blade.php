@extends('layouts.admin')
@section('title','Edit User')
@section('content')
@include('includes.banner',['one'=>'User','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.user.update',$user->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{$user->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input value="{{$user->mobile}}" type="text" class="form-control" name="mobile"
                                 required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled value="{{$user->email}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input value="{{$user->dob}}" type="date" class="form-control" name="dob" max="{{ date('Y-m-d') }}"  min="1947-01-01" required>
                        </div>
                        <div class="form-group">
                                <label>Gender</label>
                                <select required class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ ($user->gender == "Male") ? "selected" : ''}}>Male</option>
                                    <option value="Female" {{ ($user->gender == "Female") ? "selected" : ''}}>Female</option>
                                    <option value="Other" {{ ($user->gender == "Other") ? "selected" : ''}} >Other</option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input value="{{$user->address}}" type="text" class="form-control" name="address" required>
                        </div>
                       <div class="form-group">
                           <label>District</label>
                           <input type="text" class="form-control" name="district" id="district" value="{{$user->district}}">
                       </div>

                       <div class="form-group">
                           <label>Police Station</label>
                           <input type="text" class="form-control" name="police_station" id="police_station" value="{{$user->police_station}}">
                       </div>


                       <div class="form-group">
                           <label>Post Office</label>
                           <input type="text" class="form-control" name="post_office" id="post_office" value="{{$user->post_office}}">

                       </div>


                        <div class="form-group">
                            <label>User Image</label>
                            <img height="160px" width="130px" src="{{asset('images/'.$user->image)}}" alt="">
                            <input class="form-control" type="file" name="image" accept="image/*" />
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
