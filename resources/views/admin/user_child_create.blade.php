@extends('layouts.admin')
@section('title', 'Add User Child')
@section('content')
@include('includes.banner',['one'=>'User Child','two'=>'Create'])
<div class="section-body">
    <div class="row">
        {{-- <form action="{{route('admin.user.store')}}" method="POST">
        @csrf
        <input type="text" name="ratul" />
        <input type="submit" value="submit">
        </form> --}}
        <div class="col-12 col-md-12 col-lg-12">
            <form id="" class="form-group" action="{{ route('admin.user.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add User Child</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Parent User</label>
                            <input readonly value="{{ $user->name }}" type="text" class="form-control">
                            <input hidden value="{{ $user->id }}" type="text" class="form-control" name="parent_id">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input readonly value="{{ $user->mobile }}" type="text" class="form-control" name="mobile"
                                placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Relationship</label>
                            <select required class="form-control" name="relationship" id="relationship">
                                <option value="">Select Relationship</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Parent">Parent</option>
                                <option value="Siblings">Siblings</option>
                                <option value="Pet">Pet</option>
                                <option value="Cattle">Cattle</option>
                                <option value="Relative">Relative</option>
                                <option value="Neighbour">Neighbour</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input value="{{ old('dob') }}" type="date" class="form-control" name="dob"
                                max="{{ date('Y-m-d') }}" min="1947-01-01" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select required class="form-control" name="gender" id="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input value="{{ old('address') }}" type="text" class="form-control" name="address"
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
                                title="At least 1 Uppercase,At least 1 Lowercase,At least 1 Number,At least 1 Symbol( !@#$%^&*_=+- ),Min 8 chars and Max 12 chars"
                                required>
                        </div>

                        <div class="form-group">
                            <label>User Image</label>
                            <input required class="form-control" type="file" name="image" accept="image/*" />
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <input class="btn btn-primary mr-1" type="submit" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection