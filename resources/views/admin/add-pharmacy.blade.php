@extends('layouts.admin')
@section('title','Add Pharmacy')
@section('content')
@include('includes.banner',['one'=>'Pharmacy','two'=>'Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Pharmacy</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Store Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Store Licence Number</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Store Mobile No.</label>
                            <input type="text" class="form-control" name="mobile" value="+8801XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Store Alternative Mobile No.</label>
                            <input type="text" class="form-control" name="mobile" value="+8801XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Store inCharge Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Store inCharge Contact No</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>

                        <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-control" name="district" id="district">

                        </div>
                        <div class="form-group">
                            <label>Police Station</label>
                            <input type="text" class="form-control" name="ps" id="ps">
                        </div>


                        <div class="form-group">
                            <label>Post Office</label>
                            <input type="text" class="form-control" name="po" id="po">

                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="<?= bin2hex(openssl_random_pseudo_bytes(4)) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Store (Shop) Image</label>
                            <input class="form-control" type="file" name="user_image" accept="image/*" />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Add New</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
