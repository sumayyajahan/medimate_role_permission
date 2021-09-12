@extends('layouts.admin')
@section('title','Doctor Wallet View')
@section('content')
@include('includes.banner',['one'=>'Doctor Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.doctor-wallet.update',$doctorWallet->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Doctor Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> Doctor name</label>
                            <input disabled type="text" value="{{$doctorWallet->doctor->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Doctor Id</label>
                            <input disabled type="text" value="{{$doctorWallet->doctor->doctorid}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Doctor Mobile</label>
                            <input disabled type="text" value="{{$doctorWallet->doctor->mobile}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Doctor Address</label>
                            <input disabled type="text" value="{{$doctorWallet->doctor->address}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Balance</label>
                            <input disabled step=".01" type="number" class="form-control" value="{{$doctorWallet->balance}}" name="balance" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection