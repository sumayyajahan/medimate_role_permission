@extends('layouts.admin')
@section('title','User Wallet View')
@section('content')
@include('includes.banner',['one'=>'User Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.user-wallet.update',$userWallet->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View User Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> User name</label>
                            <input disabled type="text" value="{{$userWallet->user->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> User Id</label>
                            <input disabled type="text" value="{{$userWallet->user->userid}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> User Mobile</label>
                            <input disabled type="text" value="{{$userWallet->user->mobile}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> User Address</label>
                            <input disabled type="text" value="{{$userWallet->user->address}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Balance</label>
                            <input disabled step=".01" type="number" class="form-control" value="{{$userWallet->balance}}" name="balance" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection