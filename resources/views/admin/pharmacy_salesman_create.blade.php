@extends('layouts.admin')
@section('title', 'Add Representatives')
@section('content')
@include('includes.banner',['one'=>'Pharmacy Representatives','two'=>'Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{ route('admin.pharmacy-salesman.store') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add Pharmacy Sales Representative</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Pharmacy</label>
                            <select class="form-control" name="pharmacy_id" id="">
                                @foreach ($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" value="{{ old('mobile') ?? '+880' }}" minlength="14"
                                name="mobile" value="01XXXXXXXXX" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="Qq@12345678"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
                                title="At least 1 Uppercase,At least 1 Lowercase,At least 1 Number,At least 1 Symbol( !@#$%^&*_=+- ),Min 8 chars and Max 12 chars"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
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