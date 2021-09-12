@extends('layouts.admin')
@section('title','Edit Service Provider')
@section('content')
@include('includes.banner',['one'=>'Service Provider','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group"
                action="{{route('admin.service-provider.update',$serviceProvider->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Service Provider</h4>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{$serviceProvider->name}}" type="text" class="form-control" name="name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input value="{{$serviceProvider->mobile}}" type="text" class="form-control" name="mobile"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled value="{{$serviceProvider->email}}" type="email" class="form-control"
                                name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Date of birth</label>
                            <input value="{{$serviceProvider->dob}}" type="date" class="form-control"
                                name="dob">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select required class="form-control" name="gender" id="gender">
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
                            <input value="{{$serviceProvider->address}}" type="text" class="form-control" name="address"
                                required>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control" name="district" id="district" value="{{$serviceProvider->district}}">
                        </div>

                        <div class="form-group">
                            <label>Police Station</label>
                            <input type="text" class="form-control" name="police_station" id="police_station" value="{{$serviceProvider->police_station}}">
                        </div>


                        <div class="form-group">
                            <label>Post Office</label>
                            <input type="text" class="form-control" name="post_office" id="post_office" value="{{$serviceProvider->post_office}}">

                        </div>


                        <div class="form-group">
                            <label>Service Provider Image</label>
                            <img height="160px" width="130px" src="{{asset('images/'.$serviceProvider->image)}}" alt="">
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
