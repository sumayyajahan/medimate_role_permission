@extends('layouts.admin')
@section('title','View Pharmacy')
@section('content')
@include('includes.banner',['one'=>'Pharmacy','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="#" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Pharmacy</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Store Name</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->name}}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Store Licence Number</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->license}}" name="license">
                        </div>
                        <div class="form-group">
                            <label>Store Mobile No.</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->mobile}}" name="mobile"
                                minlength="11" maxlength="11" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Store Alternative Mobile No.</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->mobile_2}}" name="mobile_2"
                                minlength="11" maxlength="11" value="01XXXXXXXXX">
                        </div>
                        <div class="form-group">
                            <label>Store inCharge Name</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->incharge}}" name="incharge"
                                required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Store inCharge Contact No</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacy->name}}" name="name" required>
                    </div> --}}

                    <div class="form-group">
                        <label>Email</label>
                        <input disabled type="email" class="form-control" value="{{$pharmacy->email}}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input disabled type="text" class="form-control" value="{{$pharmacy->address}}" name="address" required>
                    </div>

                    <div class="form-group">
                        <label>District</label>
                        <select disabled class="form-control" name="district" required id="">
                            <option value="{{$pharmacy->district}}">{{$pharmacy->district}}</option>
                            <option value="District 1">District 1</option>
                            <option value="District 2">District 2</option>
                            <option value="District 3">District 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Police Station</label>
                        <select disabled class="form-control" name="police_station" id="">
                            <option value="{{$pharmacy->police_station}}">{{$pharmacy->police_station}}</option>
                            <option value="Police Station 1">Police Station 1</option>
                            <option value="Police Station 2">Police Station 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Post Office</label>
                        <select disabled class="form-control" name="post_office" id="">
                            <option value="{{$pharmacy->post_office}}">{{$pharmacy->post_office}}</option>
                            <option value="Post Office 2">Post Office 2</option>
                            <option value="Post Office 3">Post Office 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Store (Shop) Image</label>
                        <img alt="No Image Found" src="{{asset('images/'.$pharmacy->image)}}" alt="">
                    </div>


                </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection