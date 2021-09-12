@extends('layouts.admin')
@section('title','Edit Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.doctor.update',$doctor->id)}}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Doctor</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{$doctor->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input value="{{$doctor->mobile}}" type="text" class="form-control" name="mobile"
                                value="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input readonly value="{{$doctor->email}}" type="email" class="form-control" name="email"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input value="{{$doctor->dob}}" type="date" class="form-control" name="dob">
                        </div>
                        <div class="form-group">
                            <label>Nid</label>
                            <input value="{{$doctor->nid}}" type="text" class="form-control" name="nid">
                        </div>
                        <div class="form-group">
                            <label>BMDC REG No.</label>
                            <input value="{{$doctor->bmdc_reg}}" type="text" class="form-control" name="bmdc_reg">
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input value="{{$doctor->department}}" type="text" class="form-control" name="department">
                        </div>
                        <div class="form-group">
                            <label>Degree</label>
                            <input value="{{$doctor->degree}}" type="text" class="form-control" name="degree">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input value="{{$doctor->designation}}" type="text" class="form-control" name="designation">
                        </div>
                        <div class="form-group">
                            <label>Specialization</label><br>
                            @foreach ($specializations as $specialization)
                            <input value="{{ $specialization->id }}"
                            @if (in_array($specialization->id,$docotrSpecializations))
                                checked
                            @endif
                            type="checkbox" class=""
                                name="specializations[]" /> {{$specialization->name}}<br>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input value="{{$doctor->address}}" type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control" name="district" id="district"
                                value="{{$doctor->district}}">
                        </div>

                        <div class="form-group">
                            <label>Police Station</label>
                            <input type="text" class="form-control" name="police_station" id="police_station"
                                value="{{$doctor->police_station}}">
                        </div>


                        <div class="form-group">
                            <label>Post Office</label>
                            <input type="text" class="form-control" name="post_office" id="post_office"
                                value="{{$doctor->post_office}}">

                        </div>

                        <div class="form-group">
                            <label>Doctor Image</label>
                            <img height="160px" width="130px" src="{{asset('images/'.$doctor->image)}}" alt="">
                            <input class="form-control" type="file" name="image" accept="image/*" />
                        </div>


                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $doctor->status==0?'selected':'' }}>Inactive</option>
                                <option value="1" {{ $doctor->status==1?'selected':'' }}>Active</option>
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
