@extends('layouts.admin')
@section('title',' Change Password')
@section('content')
@include('includes.banner',['one'=>'Admin Password','two'=>'Change Password'])
<div class="section-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card" id="sample-login">
                <form class="" method="POST" id="change-password-form" action="{{ route('admin.change.password') }}">
                    @csrf
                    <div class="card-header">
                        <h4>Admin Password Change</h4>
                    </div>
                    <div class="card-body pb-0">
                        <p class="text-muted"></p>
                        <input type="hidden" name="admin_id" value="">

                        <div class="form-group">
                            <label>Old Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="password" name="oldpassword" class="form-control"
                                    placeholder="Old Password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" minlength="8" name="password" class="form-control"
                                    placeholder="New Password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Retype New Password" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer pt-">
                        <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection