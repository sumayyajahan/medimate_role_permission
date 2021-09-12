@extends('layouts.admin')
@section('title','View Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Doctor</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled value="{{$doctor->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled value="{{$doctor->mobile}}" type="text" class="form-control" name="mobile"
                                minlength="11" maxlength="11" value="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled disabled value="{{$doctor->email}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input disabled value="{{$doctor->dob}}" type="date" class="form-control" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label>Nid</label>
                            <input disabled value="{{$doctor->nid}}" type="text" class="form-control" name="nid" required>
                        </div>
                        <div class="form-group">
                            <label>BMDC REG No.</label>
                            <input disabled value="{{$doctor->bmdc_reg}}" type="text" class="form-control" name="bmdc_reg" required>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input disabled value="{{$doctor->department}}" type="text" class="form-control" name="department" required>
                        </div>
                        <div class="form-group">
                            <label>Degree</label>
                            <input disabled value="{{$doctor->degree}}" type="text" class="form-control" name="degree" required>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input disabled value="{{$doctor->designation}}" type="text" class="form-control" name="designation" required>
                        </div>
                       <div class="form-group">
                            <label>Specialization</label><br>
                            @foreach ($specializations as $specialization)
                            @if(in_array($specialization->id,$docotrSpecializations))
                            {{-- <input value="{{ $specialization->id }}" 
                            checked
                            type="checkbox" class="form-control"
                            name="specializations[]" />  --}}
                            {{$specialization->name}}<br>
                            @endif
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input disabled value="{{$doctor->address}}" type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <select disabled required class="form-control" name="district" id="">
                                <option value="{{$doctor->district}}">{{$doctor->district}}</option>
                                <option value="District 1">District 1</option>
                                <option value="District 2">District 2</option>
                                <option value="District 3">District 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Police Station</label>
                            <select disabled required class="form-control" name="police_station" id="">
                                <option value="{{$doctor->police_station}}">{{$doctor->police_station}}</option>
                                <option value="Police Station 2">Police Station 2</option>
                                <option value="Police Station 3">Police Station 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Post Office</label>
                            <select disabled required class="form-control" name="post_office" id="">
                                <option value="{{$doctor->post_office}}">{{$doctor->post_office}}</option>
                                <option value="PPost Office 2">Post Office 1</option>
                                <option value="Post Office 3">Post Office 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Doctor Image</label>
                            <img height="480px" width="320px" src="{{asset('images/'.$doctor->image)}}" alt="">
                           
                        </div>


                    </div>
                   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection