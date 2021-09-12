@extends('layouts.admin')
@section('title', 'Add Doctor')
@section('content')
    @include('includes.banner',['one'=>'Doctor','two'=>'Create'])
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form id="add-account" class="form-group" action="{{ route('admin.doctor.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add New Doctor</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" name="name"  required>
                            </div>
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input value="{{ old('mobile') ?? '+880' }}" minlength="14" type="text" class="form-control" name="mobile"
                                 placeholder="+8801XXXXXXXXX" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input value="{{ old('email') }}" type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input value="{{ old('dob') }}" type="date" class="form-control" name="dob" max="{{ date('Y-m-d',strtotime('-18 years')) }}"  min="1947-01-01"  required>
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select required class="form-control" name="gender" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nid</label>
                                <input value="{{ old('nid') }}" type="text" class="form-control" name="nid" required>
                            </div>
                            <div class="form-group">
                                <label>BMDC REG No.</label>
                                <input value="{{ old('bmdc_reg') }}" type="text" class="form-control" name="bmdc_reg"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <input value="{{ old('department') }}" type="text" class="form-control" name="department"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Degree</label>
                                <input value="{{ old('degree') }}" type="text" class="form-control" name="degree" required>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input value="{{ old('designation') }}" type="text" class="form-control" name="designation"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Specialization</label><br>
                                @foreach ($specializations as $specialization)
                                <input value="{{ $specialization->id }}" type="checkbox" class="" name="specializations[]"
                                     /> {{$specialization->name}} <br>
                                    @endforeach
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input value="{{ old('address') }}" type="text" class="form-control" name="address"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>District</label>
                                <input required type="text" value="{{ old('district') }}" class="form-control" name="district" id="district">

                            </div>
                            <div class="form-group">
                                <label>Police Station</label>
                                <input required value="{{ old('police_station') }}" type="text" class="form-control" name="police_station" id="police_station">
                            </div>


                            <div class="form-group">
                                <label>Post Office</label>
                                <input required value="{{ old('post_office') }}" type="text" class="form-control" name="post_office" id="post_office">

                            </div>
                            

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="Qq@12345678"
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
                                    title="At least 1 Uppercase,At least 1 Lowercase,At least 1 Number,At least 1 Symbol( !@#$%^&*_=+- ),Min 8 chars and Max 12 chars"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Doctor Image</label>
                                <input required class="form-control" type="file" name="image" accept="image/*" />
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
