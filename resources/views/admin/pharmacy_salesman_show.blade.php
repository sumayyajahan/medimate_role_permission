@extends('layouts.admin')
@section('title','View Representatives')
@section('content')
@include('includes.banner',['one'=>'Pharmacy Representatives','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.pharmacy-salesman.update',$pharmacySalesman->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Pharmacy Sales Representative</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Pharmacy</label>
                            <select disabled class="form-control" name="pharmacy_id" id="">
                                @foreach ($pharmacies as $pharmacy)
                                <option @if ($pharmacy->id == $pharmacySalesman->pharmacy->id)
                                    selected
                                @endif value="{{$pharmacy->id}}">{{$pharmacy->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacySalesman->name}}" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacySalesman->mobile}}" name="mobile" minlength="11" maxlength="11"
                                value="01XXXXXXXXX" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input disabled type="text" class="form-control" value="{{$pharmacySalesman->email}}" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <img src="{{asset('images/'.$pharmacySalesman->image)}}" alt="">
                            
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection