@extends('layouts.admin')
@section('title','Doctor Wallet Edit')
@section('content')
@include('includes.banner',['one'=>'Doctor Wallet','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.doctor-wallet.update',$doctorWallet->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Doctor Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> Doctor</label>
                            <select disabled name="doctor_id" class="form-control" id="">
                                @foreach ($doctors as $doctor)
                                    <option @if ($doctor->id == $doctorWallet->doctor_id) selected
                                        
                                    @endif value="{{$doctor->id}}">{{$doctor->name}} - {{$doctor->doctorid}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input step=".01" type="number" class="form-control" value="{{$doctorWallet->balance}}" name="balance" required>
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