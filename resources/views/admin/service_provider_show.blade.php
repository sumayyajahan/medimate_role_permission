@extends('layouts.admin')
@section('title','View Service Provider')
@section('content')
@include('includes.banner',['one'=>'Service Provider','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group"
               
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Service Provider</h4>
                    </div>
                    
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled value="{{$serviceProvider->name}}" type="text" class="form-control" name="name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled value="{{$serviceProvider->mobile}}" type="text" class="form-control" name="mobile"
                                minlength="11" maxlength="11" value="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled  value="{{$serviceProvider->email}}" type="email" class="form-control"
                                name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select disabled required class="form-control" name="gender" id="gender">
                                <option value="Male" {{ ($serviceProvider->gender == "Male") ? "selected" : ''}}>Male
                                </option>
                                <option value="Female" {{ ($serviceProvider->gender == "Female") ? "selected" : ''}}>
                                    Female</option>
                                <option value="Other" {{ ($serviceProvider->gender == "Other") ? "selected" : ''}}>Other
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input disabled value="{{$serviceProvider->address}}" type="text" class="form-control" name="address"
                                required>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <select disabled required class="form-control" name="district" id="">
                                <option value="{{$serviceProvider->district}}">{{$serviceProvider->district}}</option>
                                <option value="District 1">District 1</option>
                                <option value="District 2">District 2</option>
                                <option value="District 3">District 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Police Station</label>
                            <select disabled required class="form-control" name="police_station" id="">
                                <option value="{{$serviceProvider->police_station}}">
                                    {{$serviceProvider->police_station}}</option>
                                <option value="Police Station 2">Police Station 2</option>
                                <option value="Police Station 3">Police Station 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Post Office</label>
                            <select disabled required class="form-control" name="post_office" id="">
                                <option value="{{$serviceProvider->post_office}}">{{$serviceProvider->post_office}}
                                </option>
                                <option value="PPost Office 2">Post Office 1</option>
                                <option value="Post Office 3">Post Office 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Service Provider Image</label>
                            <img height="160px" width="130px" src="{{asset('images/'.$serviceProvider->image)}}" alt="">
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection