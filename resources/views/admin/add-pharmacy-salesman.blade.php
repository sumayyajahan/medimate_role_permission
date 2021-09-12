@extends('layouts.admin')
@section('title','Add Representatives')
@section('content')
@include('includes.banner',['one'=>'Pharmacy Representatives','two'=>'Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="add-account.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Pharmacy Sales Representative</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Pharmacy</label>
                            <select class="form-control" name="district" id="">
                                <option value="">Select Pharmacy</option>
                                <option value="">Pharmacy 1</option>
                                <option value="">Pharmacy 2</option>
                                <option value="">Pharmacy 3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" name="mobile" minlength="11" maxlength="11" value="01XXXXXXXXX" required>
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
                            <label>Image</label>
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
