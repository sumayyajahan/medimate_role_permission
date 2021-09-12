@extends('layouts.admin')
@section('title','Edit Pharmacy')
@section('content')
@include('includes.banner',['one'=>'Pharmacy','two'=>'Edit'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.pharmacy.update',$pharmacy->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Pharmacy</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Store Name</label>
                            <input type="text" class="form-control" value="{{$pharmacy->name}}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Store Licence Number</label>
                            <input type="text" class="form-control" value="{{$pharmacy->license}}" name="license">
                        </div>
                        <div class="form-group">
                            <label>Store Mobile No.</label>
                            <input type="text" class="form-control" value="{{$pharmacy->mobile}}" name="mobile"
                                minlength="11" maxlength="11" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Store Alternative Mobile No.</label>
                            <input type="text" class="form-control" value="{{$pharmacy->mobile_2}}" name="mobile_2"
                                minlength="11" maxlength="11" value="">
                        </div>
                        <div class="form-group">
                            <label>Store inCharge Name</label>
                            <input type="text" class="form-control" value="{{$pharmacy->incharge}}" name="incharge"
                                required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Store inCharge Contact No</label>
                            <input type="text" class="form-control" value="{{$pharmacy->name}}" name="name" required>
                    </div> --}}

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{$pharmacy->email}}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" value="{{$pharmacy->address}}" name="address" required>
                    </div>

                    <div class="form-group">
                        <label>District</label>
                        <input type="text" class="form-control" name="district" id="district" value="{{$pharmacy->district}}">
                    </div>

                    <div class="form-group">
                        <label>Police Station</label>
                        <input type="text" class="form-control" name="police_station" id="police_station" value="{{$pharmacy->police_station}}">
                    </div>


                    <div class="form-group">
                        <label>Post Office</label>
                        <input type="text" class="form-control" name="post_office" id="post_office" value="{{$pharmacy->post_office}}">

                    </div>


                    <div class="form-group">
                        <label>Store (Shop) Image</label>
                        <img height="160px" width="130px" src="{{asset('images/'.$pharmacy->image)}}" alt="">
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
