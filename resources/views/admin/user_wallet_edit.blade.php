@extends('layouts.admin')
@section('title','User Wallet Edit')
@section('content')
@include('includes.banner',['one'=>'User Wallet','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.user-wallet.update',$userWallet->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit User Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> User</label>
                            <select disabled name="user_id" class="form-control" id="">
                                @foreach ($users as $user)
                                    <option @if ($user->id == $userWallet->user_id) selected
                                        
                                    @endif value="{{$user->id}}">{{$user->name}} - {{$user->userid}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input step=".01" type="number" class="form-control" value="{{$userWallet->balance}}" name="balance" required>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection