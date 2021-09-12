@extends('layouts.admin')
@section('title', 'Add Pharmacy')
@section('content')
    @include('includes.banner',['one'=>'Pharmacy','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form id="add-account" class="form-group" action="{{ route('admin.pharmacy.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add New Pharmacy</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Store Name</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Store Licence Number</label>
                                <input type="text" class="form-control" value="{{ old('license') }}" name="license">
                            </div>
                            <div class="form-group">
                                <label>Store Mobile No.</label>
                                <input type="text" class="form-control" value="{{ old('mobile') }}" name="mobile"
                                    placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="form-group">
                                <label>Store Alternative Mobile No.</label>
                                <input type="text" class="form-control" value="{{ old('mobile_2') }}" name="mobile_2"
                                    value="01XXXXXXXXX">
                            </div>
                            <div class="form-group">
                                <label>Store inCharge Name</label>
                                <input type="text" class="form-control" value="{{ old('incharge') }}" name="incharge"
                                    required>
                            </div>
                            {{-- <div class="form-group">
                                <label>Store inCharge Contact No</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
                            </div> --}}

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ old('email') }}" name="email" required>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" value="{{ old('address') }}" name="address"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>District</label>
                                <input type="text" class="form-control" name="district" id="district">
                            </div>

                            <div class="form-group">
                                <label>Police Station</label>
                                <input type="text" class="form-control" name="police_station" id="police_station">
                            </div>


                            <div class="form-group">
                                <label>Post Office</label>
                                <input type="text" class="form-control" name="post_office" id="post_office">

                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="Qq@12345678"
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
                                    title="At least 1 Uppercase,At least 1 Lowercase,At least 1 Number,At least 1 Symbol( !@#$%^&*_=+- ),Min 8 chars and Max 12 chars"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Store (Shop) Image</label>
                                <input class="form-control" type="file" name="image" accept="image/*" />
                            </div>


                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary mr-1" type="submit" name="submit">Add New</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
