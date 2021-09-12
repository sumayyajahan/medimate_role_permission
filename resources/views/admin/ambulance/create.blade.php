<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Add Ambulance Service')
@section('content')
    @include('includes.banner',['one'=>'Ambulance','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form  class="form-group" action="{{route('admin.ambulance.store')}}" method="post"
                       enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Ambulance Service</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{old('name')}}" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input value="{{old('address')}}" type="text" class="form-control" name="address" required>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input value="{{old('phone')}}" type="text" class="form-control" name="phone" required>
                            </div>


                            <div class="form-group">
                                <label>Division</label>
                                <select name="district_id" id="" class="form-control">
                                    <option value="">Select Division</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>

                            </div>



                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary mr-1" type="submit" >Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
